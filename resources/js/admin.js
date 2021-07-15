require("./bootstrap");

/**
 * delete post confirm
 */

const delform = document.querySelectorAll('.delete-post-form');

delform.forEach(form =>{
    // conferma del delete
   form.addEventListener('submit', function(e){
         const resp = confirm('Sicuro di voler cancellare definitivamente?');

         // se annullo il delete no submit
         if(!resp){
            e.preventDefault();
         }
   });
});
