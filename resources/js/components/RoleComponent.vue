<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <input type="text" name="search" class="form-control" id="" v-model="name" placeholder="search">
                <a class="btn btn-primary float-right mb-2 mt-4" @click="supp_valid" data-toggle="modal" data-target="#createModal">Add</a>
                
                <hr>
                <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>                    
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for ="(role, index) in searchrole" v-bind:key="role.id">                   
                    <td>{{index+1}}</td>
                    <td>{{role.name}}</td>
                    <td>                   
                        <a @click="edit(role.id)" class="btn btn-sm btn-success" data-toggle="modal" data-target="#updateModal">edit</a>
                        <a @click="del(role.id)" class="btn btn-sm btn-danger">x</a>
                        
                    </td>
                    </tr>                                        
                </tbody>
                </table>
            </div>
        </div>


        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-8">
                    <form @submit.prevent="submitrole">               
                        <div class="form-group">
                            <label for="name">roles</label>
                            <input type="text" class="form-control" v-model="name" name="name" placeholder="المصلحة">                        
                        </div>                    
                        <div v-if="this.errors.length!=0" class="alert alert-danger">
                            <ul>
                                <li v-for = "(error,index) in errors.name" v-bind:key="index">
                                    {{error}}
                                </li>
                            </ul>
                        </div>
                        <button type="submit" class="btn btn-primary">تسجيل</button>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                
            </div>
            </div>
        </div>
        </div>

        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-8">
                        <form @submit.prevent="update()">               
                            <div class="form-group">
                                <input type="hidden" name="service_id" v-model="id">
                                <label for="name">role</label>
                                <input type="text" class="form-control" v-model="name_edit" name="name" placeholder="المصلحة">                                                            
                            </div>                    
                            <div v-if="this.errors.length!=0" class="alert alert-danger">
                                <ul>
                                    <li v-for = "(error,index) in errors.name" v-bind:key="index">
                                        {{error}}
                                    </li>
                                </ul>
                            </div>                                
                            <button type="submit" class="btn btn-primary">تعديل</button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    
                </div>
                </div>
            </div>
            </div>

    </div>
</template>

<script>
    export default {        
        data(){
            return {
                id:'',
                name:'',
                name_edit:'',
                roles:[],            
                errors:[],                
            }
        },
       
        mounted() {
            this.index();            
        },
        computed:{
            searchrole : function(){
                return this.roles.filter((item)=>item.name.toUpperCase().includes(this.name.toUpperCase()));
            }
        },
        methods:{
            supp_valid(){
                this.errors=[]
            },
            submitrole(){                
                axios.post('/admin/roles',{
                    name : this.name,
                }).then(response => {
                   // this.services.push(response.data);                    
                    this.index();
                    $('#createModal').modal('hide');
                })
                .catch(error =>{                   
                    if(error.response.status==422){
                        this.errors=error.response.data.errors;                        
                    }                    
                });
            },
            index(){
                axios.get('/admin/roles'
                ).then(response=> {
                    this.roles=response.data;
                });
            },
            edit(id){  
                this.supp_valid();                   
                axios.get('/admin/roles/'+id+'/edit',{                    

                }).then(response=> {
                    this.name_edit=response.data.name;
                    this.id=response.data.id;             
                });
            },
            del(id){
                if (confirm("are you shure to delete this record?")){
                    axios.delete('/admin/roles/'+id,{

                    }).then(response=> {
                    //this.services.splice(indexof(id),1);
                    this.index();
                    
                    });

                } 
                return false;               
            },
            update(){
                this.supp_valid();
                axios.put('/admin/roles/'+this.id,{
                    name : this.name_edit,
                    id : this.id

                }).then(response=> {
                    //this.services.splice(indexof(id),1);
                    this.index();
                    $('#updateModal').modal('hide');
                    
                }).catch(error =>{                   
                    if(error.response.status==422){
                        this.errors=error.response.data.errors;      
                        console.log(error.response.data.errors.name);
                        console.log(this.errors.name) 
                    }                    
                });
            }

        }
    }
</script>
