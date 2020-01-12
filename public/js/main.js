window.addEventListener("DOMContentLoaded", (event) => {

    let editSurveyPage = RegExp('show_survey_page*');
    const pathCurrentPage =  window.location.pathname;

    if(editSurveyPage.test(pathCurrentPage)){
      var btnAddField = document.getElementById("btn_add_field_survey");
      console.log('coucou'
      )
      btnAddField.addEventListener("mouseover", function( event ) {   
        btnAddField.innerHTML = 'Ajouter un nouveau champ'
        btnAddField.style.width = '350px' 
        btnAddField.style.borderRadius = '60px'
        btnAddField.style.fontSize = '1em';
        btnAddField.style.lineHeight = '60px';
        btnAddField.style.transitionProperty = "width"
        btnAddField.style.transitionDuration = '1s';

        setTimeout(function() {
          btnAddField.innerHTML = '+' ;
          btnAddField.style.fontSize = '3em';
          btnAddField.style.width = '75px' ;
          btnAddField.style.borderRadius = '75%';
          btnAddField.style.lineHeight = '52.5px';
          btnAddField.style.transitionProperty = "width, border-radius"
          btnAddField.style.transitionDuration = '1s';
        }, 4000);
      }, false);
    }
    
    let surveysPage = RegExp('admin/survey*');

    if(surveysPage.test(pathCurrentPage)){
      var btnAddSurvey = document.getElementById("btn_add_survey");
      btnAddSurvey.addEventListener("mouseover", function( event ) {   
        console.log(btnAddSurvey.innerHTML)
        btnAddSurvey.innerHTML = 'Ajouter un nouveau formulaire'
        btnAddSurvey.style.width = '350px' 
        btnAddSurvey.style.borderRadius = '60px'
        btnAddSurvey.style.fontSize = '1em';
        btnAddSurvey.style.lineHeight = '60px';
        btnAddSurvey.style.transitionProperty = "width"
        btnAddSurvey.style.transitionDuration = '1s';
        // réinitialise la couleur après un court moment
        setTimeout(function() {
          btnAddSurvey.innerHTML = '+' ;
          btnAddSurvey.style.fontSize = '3em';
          btnAddSurvey.style.width = '75px' ;
          btnAddSurvey.style.borderRadius = '75%';
          btnAddSurvey.style.lineHeight = '52.5px';
          btnAddSurvey.style.transitionProperty = "width, border-radius"
          btnAddSurvey.style.transitionDuration = '1s';
        }, 4000);
      }, false);
      
      

      console.log("DOM entièrement chargé et analysé");
    }

  });