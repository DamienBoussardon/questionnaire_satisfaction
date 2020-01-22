
window.addEventListener("DOMContentLoaded", (event) => {

    let indexSurveyPage = RegExp('/plateforme/surveys/*');
    let editSurveyPage = RegExp('edit_survey_page*');
    let showSurveysPage = '/plateforme/surveys';
    let replyPage = RegExp('questionnaire_*');

    const pathCurrentPage =  window.location.pathname;

    if( showSurveysPage === pathCurrentPage ){
      this.custumBtnAddAction('btn_add_survey','Ajouter un nouveau formulaire')
    }

    if( indexSurveyPage.test(pathCurrentPage) ){
      this.custumBtnAddAction('btn_add_field_survey','Ajouter une question')
    }
    

    if( replyPage.test(pathCurrentPage) ){
      let modal = document.getElementById("modal");
      let modalBtnClose = document.getElementById("acceptTerms");
      modalBtnClose.addEventListener('click', function(){
          modal.classList.remove("modal_active");
      })
    }



    /**Formulaire ajout field */
    if( editSurveyPage.test(pathCurrentPage) ){

      let inputSelect = document.getElementById("field_survey_typeReply");
      
      let elementLocation = document.getElementById("location_element_added");

      inputSelect.addEventListener('change', function(){
      
        const typeSelected = inputSelect.value;
        switch (typeSelected) {
          case 'radio':
            custumInputForFormField(elementLocation, 'Radio')
            break;
          case 'checkbox':
            custumInputForFormField(elementLocation, 'Checkbox')
            break
          case 'select':
            custumInputForFormField(elementLocation, 'Select')
            break;
          default:
            elementLocation.innerHTML = "";
        }
      })
    }

});

function custumInputForFormField(elmtLocation, typeInputSelected){
  let modSyntaxTypeInput = typeInputSelected.toLowerCase();
  elmtLocation.innerHTML = `<label for=\"input${typeInputSelected}Value\" >Valeurs Associées <span>( Ces valeurs seront affichées à l'utilisateur, lorsque ce formulaire lui sera soumis )</span></label><input id=\"input${typeInputSelected}Value\" placeholder=\"Séparer vos valeur d'une virgule\" name=\"_associated_values\" type=\"text\" class=\"span12 field_form form-control\"></input>`;
}

function custumBtnAddAction(id_element, textInBtn){
    var btnAddAction = document.getElementById(id_element);
    btnAddAction.addEventListener("mouseover", function( event ) {   
      btnAddAction.innerHTML = textInBtn
      btnAddAction.style.width = '350px' 
      btnAddAction.style.borderRadius = '60px'
      btnAddAction.style.fontSize = '1em';
      btnAddAction.style.lineHeight = '60px';
      btnAddAction.style.transitionProperty = "width"
      btnAddAction.style.transitionDuration = '1s';
      // réinitialise la couleur après un court moment
      setTimeout(function() {
        btnAddAction.innerHTML = '+' ;
        btnAddAction.style.fontSize = '3em';
        btnAddAction.style.width = '75px' ;
        btnAddAction.style.borderRadius = '75%';
        btnAddAction.style.lineHeight = '52.5px';
        btnAddAction.style.transitionProperty = "width, border-radius"
        btnAddAction.style.transitionDuration = '1s';
      }, 4000);
    }, false);
}

$(function () {$('[data-toggle="tooltip"]').tooltip()}); $(function () {$('.sell').selectpicker()});