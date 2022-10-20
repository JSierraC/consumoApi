<template>
 <div class="modal fade" :id="`${id}`" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title text-black fw-bold" >{{name}}</h5>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">
         <div class="container">
           <table class="details-table ">
              <tr>
                <td class="fw-bold">Type:</td>
                <td>{{type}}</td>
              </tr>
              <tr>
                <td class="fw-bold">Height:</td>
                <td>{{height * 10}} cm</td>
              </tr>
              <tr>
                <td class="fw-bold">Weight:</td>
                <td>{{weight * 0.1}} kg</td>
              </tr>
              <tr>
                <td>
                    <b>Abilities:</b>
                    <ul class="pl-5">
                      <li v-for="(ability, index) in abilities" :key="index">
                        <span class="ability ">{{ability}}</span>
                      </li>
                    </ul>
                </td>
              </tr>
            </table>
        </div>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
       </div>
     </div>
   </div>
 </div>
</template>

<script>

export default {

  props:{
    id: "",
    name: "",
    type:"",
    height: 0,
    weight: 0,
    abilities: {}
  },
  created(){
   // console.log(this.abilities);
  }

}
</script>
<style scoped>
  

</style>
