<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <input type="text" name="search" class="form-control" id="" v-model="name" placeholder="search">
                <a class="btn btn-primary float-right mb-2 mt-4" data-toggle="modal" data-target="#exampleModal">Add</a>
                
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
                    <tr v-for ="(service, index) in searchService" v-bind:key="service.id">                   
                    <td>{{index+1}}</td>
                    <td>{{service.name}}</td>
                    <td>                   
                        <a @click="edit(service.id)" class="btn btn-sm btn-success" data-toggle="modal" data-target="#updateexampleModal">edit</a>
                        <a @click="del(service.id)" class="btn btn-sm btn-danger">x</a>
                        
                    </td>
                    </tr>                                        
                </tbody>
                </table>
            </div>
        </div>
        
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <form @submit.prevent="submitService">               
                        <div class="form-group">
                            <label for="name">المصلحة</label>
                            <input type="text" class="form-control" v-model="name" name="name" placeholder="المصلحة">                        
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

        <div class="modal fade" id="updateexampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <label for="name">المصلحة</label>
                                    <input type="text" class="form-control" v-model="name" name="name" placeholder="المصلحة">                        
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
                services:[],
                is_to_update:false,
            
            }
        },
        mounted() {
            this.index();
        },
        computed:{
            searchService : function(){
                return this.services.filter((item)=>item.name.toUpperCase().includes(this.name.toUpperCase()));
            }
        },
        methods:{
            submitService(){
                axios.post('/admin/services',{
                    name : this.name,
                }).then(response => {
                   // this.services.push(response.data);                    
                    this.index();
                    $('#exampleModal').modal('hide');
                });
            },
            index(){
                axios.get('/admin/services'
                ).then(response=> {
                    this.services=response.data;
                });
            },
            edit(id){
                this.is_to_update=true;
                axios.get('/admin/services/'+id+'/edit',{                    

                }).then(response=> {
                    this.name=response.data.name;
                    this.id=response.data.id;
                });
            },
            del(id){
                if (confirm("are you shure to delete this record?")){
                    axios.delete('/admin/services/'+id,{

                    }).then(response=> {
                    //this.services.splice(indexof(id),1);
                    this.index();
                    
                    });

                } 
                return false;               
            },
            update(){
                //this.is_to_update=true;
                axios.put('/admin/services/'+this.id,{
                    name : this.name,
                    id : this.id

                }).then(response=> {
                    //this.services.splice(indexof(id),1);
                    this.index();
                    
                });
            },
            create(){
                this.is_to_update=false;
               
            }


        }
    }
</script>
