@extends('layouts.app')
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
                        vias include
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

@endsection
