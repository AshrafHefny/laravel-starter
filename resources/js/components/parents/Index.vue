<template>
   <div class="section-wrapper">

    <div class="table-wrapper">
        <div class="row col-md-4 mb-sm-5">
                 <input  class="form-control search-filter col-md-8" v-on:keyup.enter="filter"  type="text" v-model="keyword" placeholder="Search" />
                <button @click="filter" class="btn btn-primary">Go</button>
              </div> 
        <table class="table display responsive nowrap " :class="isLoading">
            <thead>
                <tr>
                       <th class="wd-15p">
                          <a href="#" @click.prevent="sort('id')">
                            <i class=" ion ion-ios-arrow-up" v-show="sortField == 'id' && sortDirection == 'asc'"></i>
                            <i class="ion ion-ios-arrow-down" v-show="sortField == 'id' && sortDirection == 'desc'"></i>
                                {{trans('parents.ID')}} 
                          </a>
                        
                           </th>
                    <th class="wd-15p">{{trans('parents.Code')}} </th>
                    <th class="wd-15p">
                        <a href="#" @click.prevent="sort('user_id')">
                            <i class=" ion ion-ios-arrow-up" v-show="sortField == 'user_id' && sortDirection == 'asc'"></i>
                            <i class="ion ion-ios-arrow-down" v-show="sortField == 'user_id' && sortDirection == 'desc'"></i>
                                {{trans('staff.Related user')}} 
                          </a>
                        </th>
                    <th class="wd-15p">
                        <a href="#" @click.prevent="sort('gender')">
                            <i class=" ion ion-ios-arrow-up" v-show="sortField == 'gender' && sortDirection == 'asc'"></i>
                            <i class="ion ion-ios-arrow-down" v-show="sortField == 'gender' && sortDirection == 'desc'"></i>
                                  {{trans('parents.Gender')}}
                          </a>
                      
                         </th>
                    <th class="wd-15p">
                          <a href="#" @click.prevent="sort('first_name')">
                            <i class=" ion ion-ios-arrow-up" v-show="sortField == 'first_name' && sortDirection == 'asc'"></i>
                            <i class="ion ion-ios-arrow-down" v-show="sortField == 'first_name' && sortDirection == 'desc'"></i>
                                  {{trans('parents.Name')}}
                          </a>
                         </th>
                    <th class="wd-15p">{{trans('parents.Birthdate')}} </th>
                    <th class="wd-15p">&nbsp;</th>
                </tr>
            </thead>
                   <tbody>
                 <tr v-for="row in rows.data " :key="row.id">
                    <td class="center">{{row.id}}</td>
                    <td class="center">
                        <a v-bind:href="module +'/view/'+ row.id">
                            {{row.attributes.code}}
                        </a>
                    </td>
                    <td class="center">
                     
                        <a v-if="row.attributes.user_id" v-bind:href="'users/view/'+ row.attributes.user_id"  target="_blank">
                            {{row.relationships.user.attributes.name}}
                        </a>
                        <span v-else>---------</span>
                
                    </td>
                    <td class="center">{{(row.attributes.gender=='f')?trans('app.Female'):trans('app.Male')}}</td>
                    <td class="center">
                        <a v-bind:href="module +'/view/'+ row.id">
                            {{ row.attributes.name  }}
                        </a>
                    </td>
                    <td class="center">{{row.attributes.birth_date }}</td>
          
                    <td class="center">

                    
                        <a v-if="can.invite"  class="btn btn-warning btn-xs" v-bind:href="module+'/invite/'+row.id" :title="trans('parents.Invite to Application')" data-toggle="modal" :data-target="'#invite-'+row.id">
                            <i class="fa fa-android"></i>
                        </a>


                        <a v-if="can.edit"  class="btn btn-success btn-xs" v-bind:href="module +'/edit/'+ row.id" :title="trans('parents.Edit')">
                            <i class="fa fa-edit"></i>
                        </a>
                   

                        <a v-if="can.view"  class="btn btn-primary btn-xs" v-bind:href="module +'/view/'+ row.id" :title="trans('parents.View')">
                            <i class="fa fa-eye"></i>
                        </a>
                 

                        <a v-if="can.delete" class="btn btn-danger btn-xs" v-bind:href="module +'/delete/'+ row.id" :title="trans('parents.Delete')" data-confirm="trans('parents.parents.Are you sure you want to delete this item?')">
                            <i class="fa fa-trash-o"></i>
                        </a>
             
                    </td>
                </tr>
              
            </tbody>
        </table>
    </div>
            <pagination class="center" :data="rows" @pagination-change-page="getResults"></pagination>

</div>
</template>

<script>
    export default {
     data () {
        return {
          module:'parents',
          rows:{},
          permissionsValues:['view','edit','delete','invite'],
          sortBy:'',
          filterBy:'',
          sortField:'id',
          sortDirection:'asc',
          isLoading:'',
          can:{},
          keyword:''
        }
      },
      methods: {
        fetchData(page,append) {
           this.isLoading ='loading';
           if(page){
             page = "?page="+page;
           }
         return  axios.get('/api/'+this.module+page+append)
          .then(response => {
             this.isLoading ='';
             return response.data;
          });
        },
        getResults(page=1,append='&sort[]=id') {
          if(this.sortBy || this.filterBy){
             append = this.sortBy+this.filterBy;
          }
          console.log(append);
          this.fetchData(page,append).then(data => {
            this.rows = data;
            });
        },

        sort(field){
          if(this.sortField!=field){
            this.sortDirection='asc';
          }
          else{
            if(this.sortDirection=='desc')
              this.sortDirection='asc';
            else
              this.sortDirection='desc';  
          }
          this.sortField=field;
          let appendTo=(this.sortDirection=='desc')?'-'+field:''+field;
          this.sortBy ='&sort[]='+appendTo;
          this.getResults(1,'&sort[]='+appendTo);
        },
       
        confirmDelete(id){
          Swal({
              title: 'Are you sure?',
              text: "You want delete this!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {
                this.delete(id);
              }
            })

        },
        delete(id) {
            axios.delete('/api/'+this.module+'/'+id)
            .then(()=>{
              Swal(
                  'Deleted!',
                  'Your row has been deleted.',
                  'success'
                ),
                this.getResults()
           }).catch(error=>{
                Swal("Failed",error.message,'warnning')
              })
        },
         filter() {
             if(this.keyword.toLowerCase()!=""){
                this.filterBy = '&q=first_name,last_name;'+this.keyword.toLowerCase();
             }
            else{
                this.filterBy = ''; 
            }
             this.getResults(1,this.filterBy);
        },
        checkPermession() {
         return  axios.post('/api/auth/can',{'data':this.permissionsValues})
          .then(response => {
             this.can =  response.data;
          });
        }
      },
     mounted() {
            this.getResults();
            this.checkPermession();            
     }
    }
</script>
