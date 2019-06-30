<?php

namespace App\Starter\Users;

use App\Starter\BaseApp\Traits\CreatedBy;
use App\Starter\BaseApp\Traits\HasAttach;
use App\Starter\Cars\Car;
use App\Starter\Competitions\ProvidedAnswer;
use App\Starter\Departments\Department;
use App\Starter\Entities\Entity;
use App\Starter\Incidents\Incident;
use App\Starter\Options\Option;
use App\Starter\Users\Models\Citizen;
use App\Starter\Users\Models\Contractor;
use App\Starter\Users\Models\Editor;
use App\Starter\Users\Models\Employee;
use App\Starter\Users\Models\FirebaseToken;
use App\Starter\Users\Models\Role;
use App\Starter\Users\Models\Supervisor;
use App\Starter\Users\Models\Worker;
use App\Starter\Violations\Violation;
use App\Starter\WorkingArea\WorkingArea;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Scout\Searchable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use SoftDeletes, Searchable, LaratrustUserTrait, CreatedBy, HasAttach, Notifiable;

    protected static $attachFields = [
        'profile_picture' => [
            'sizes' => ['small' => 'crop,400x300', 'large' => 'resize,800x600'],
            'path' => 'uploads'
        ],
    ];
    protected $table = "users";
    protected $fillable = [
        'name',
        'type',
        'email',
        'mobile_number',
        'address',
        'last_logged_in_at',
        'confirmed',
        'super_admin',
        'is_admin',
        'password',
        'is_active',
        'profile_picture',
        'language'
    ];

    public function setPasswordAttribute($value)
    {
        if (trim($value)) {
            $this->attributes['password'] = bcrypt(trim($value));
        }
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', '=', 1)->where('confirmed', 1);
    }

    public function getUserTypes()
    {
        return UserEnums::userTypes();
    }

    public function getRoles()
    {
        return Role::get();
    }

    public function scopeNotSuperAdmin($query)
    {
        return $query->where('super_admin', '=', 0);
    }

    public function scopeWithoutLoggedUser($query)
    {
        return $query->where('id', '!=', auth()->id());
    }

    public function getData()
    {
        $query = $this->withoutLoggedUser()
            ->notsuperadmin()
            ->when(request('type'), function ($q) {
                return $q->where('type', request('type'));
            })
            ->when(request('deleted') == 'yes', function ($q) {
                return $q->onlyTrashed();
            });
        return $query;
    }

    public function export($rows, $fileName)
    {
        if ($rows) {
            foreach ($rows as $row) {
                unset($object);
                $object['id'] = $row->id;
                $object['Name'] = $row->name;
                $object['Email'] = $row->email;
                $object['Mobile'] = $row->mobile_number;
                $object['Is Admin'] = ($row->is_admin) ? 'Yes' : 'No';
                $object['Created at'] = $row->created_at;
                $labels = array_keys($object);
                $data[] = $object;
            }
            export($data, $labels, $fileName);
        }
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return $this->toArray();
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getOptionsCarState($type = 'car_state')
    {
        $query = Option::active();
        if ($type) {
            $query = $query->where('type', $type);
        }
        return $query->listsTranslations('title')->pluck('title', 'id')->toArray();
    }

    public function getOptionsCarBrand($type = 'car_brand')
    {
        $query = Option::active();
        if ($type) {
            $query = $query->where('type', $type);
        }
        return $query->listsTranslations('title')->pluck('title', 'id')->toArray();
    }

    public function getOptionsCarType($type = 'car_type')
    {
        $query = Option::active();
        if ($type) {
            $query = $query->where('type', $type);
        }
        return $query->listsTranslations('title')->pluck('title', 'id')->toArray();
    }

    public function getOptionsCarCategoryType($type = 'car_category')
    {
        $query = Option::active();
        if ($type) {
            $query = $query->where('type', $type);
        }
        return $query->listsTranslations('title')->pluck('title', 'id')->toArray();
    }


    /**
     * Route notifications for the FCM channel.
     *
     * @param Notification $notification
     * @return string
     */
    public function routeNotificationForFcm($notification)
    {
        return $this->firebaseTokens->pluck('token')->toArray();
    }
}
