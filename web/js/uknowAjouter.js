/**
 * Created by thomas on 17/03/15.
 */

var list = document.getElementById('uknow_platformbundle_ajout_type'),
    editCours = document.getElementById('cours'),
    editExercice = document.getElementById('exercice');

list.addEventListener('change', function() {

   if(list.options[list.selectedIndex].innerHTML == 'Cours'){
        editCours.style.display = 'block';
        editExercice.style.display = 'none';
   }else if(list.options[list.selectedIndex].innerHTML == 'Exercice'){
        editCours.style.display = 'none';
        editExercice.style.display = 'block';
   }

}, true);

