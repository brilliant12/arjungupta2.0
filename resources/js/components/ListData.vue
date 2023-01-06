<template>
   <span class="text-danger">{{ error!=''?error:'' }}</span> 
    <form id="form-data">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="email" class="form-control" v-model="form.name" id="name" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" class="form-control" id="slug" v-model="form.slug">
        </div>
        <br>
        <button type="button" class="btn btn-primary" v-if="id==''" @click="saveData">Submit</button>
        <button type="button" class="btn btn-primary" v-else @click="update(id)">update</button>
    </form>
    <br>
<table class="table table-border table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Slug</th>
            <th colspan="2" class="text-center">Action</th>
        </tr>
        </thead>
        <tbody>
            <template v-for="data of list" :key="data.id">
                <tr>
                    <td>{{ data.id }}</td>
                    <td>{{ data.name }}</td>
                    <td>{{ data.slug }}</td>
                    <td><button class="btn btn-primary"  @click="edit_data(data)">Edit</button></td>
                    <td><button class="btn btn-danger" @click="delete_data(data.id)">delete</button></td>
                </tr>
            </template>
          
        </tbody>
  
</table>
    
 
</template>
<script>
import { ref,onMounted,reactive } from 'vue';
import axios from 'axios';
import { remove } from '@vue/shared';

export default {
   
    setup() 
    {
     let list=ref([]);
     let error=ref([]);
     let id=ref([]);
     let form=reactive({
        'name':'',
        'slug':''
     });
     const allList=async()=>{
         let res = await axios.get('/api/v1/skill');
       list.value=res.data;
      
       
     }
     
         const saveData = async () => {
             try {  
              let response=  await axios.post('/api/v1/skill', form);
             FormRest();  
             allList();
            
         }
             catch (e) {
                 if (e.response.status = 422) {
                    error.value= e.response.data;
                 }
             }
     }
        const edit_data=(data)=>{
          id.value=data.id;
          form.name=data.name;
          form.slug=data.slug;
          error.value='';
        }
        const update=async(id)=>{
            form.id=id;
            await axios.post('/api/v1/skill-update',form);
            console.log(form);
            delete form.id;
            FormRest();
            allList();
        }
        const delete_data =async(id)=>{
            form.id=id;
            await axios.post('/api/v1/skill-delete',form);
            console.log(form);
            delete form.id;
            allList();
        }
     const FormRest=()=>{
        id.value='';
        form.name= '',
        form.slug=''
        
     }
    
     
     onMounted(allList())

     return {
         list, form, saveData, error, edit_data, id, update,delete_data
     }

    }
}
</script>