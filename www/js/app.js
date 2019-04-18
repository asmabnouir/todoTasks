$(function(){

  //---------------------add task --------------------------
  //Ajouter une nouvelle tache au debut de la liste

  $('body').on('change' ,'#new_todo',function(){
                $.ajax({
                  url:'tasks/add',
                  data: {
                    content: $('#new_todo').val(),
                  },
                  method: 'post',
                  success: function(reponsePHP){
                    $('.todo-list').prepend(reponsePHP);
                    $('#new_todo').val('');
                    //je lance le countRest pr màj le footer
                    countRest();
                  }
                });

                });


  //---------------------delete task --------------------------
  // Supprimer une tache de la liste

  $('.todo-list').on('click' ,'.destroy',function(){
    var that = $(this);
              $.ajax({
                url:'tasks/delete/'+ $(this).closest('li').attr('data-id'),

                success: function(reponsePHP){
                  that.closest('li')
                                 .find('div')
                                 .slideUp(function(){
                                  $(this).closest('li').remove();
                                  //je lance le countRest pr màj le footer
                                   countRest();
                                   });


                }

              });

  });

  //---------------------toggle task --------------------------
  //changer la classe de la tache (copmpleted si elle est finie )
  //envoyer la valeur de finshed 0/1 en post selon l'état du checkbox

  $('.todo-list').on('click', '.toggle',function(){
            var that = $(this);
            $.ajax({
              url:'tasks/toggleFinish/'+ $(this).closest('li').attr('data-id'),
              data:{
              finished: $(this).prop("checked") ? 1 : 0
              },
              method:'post',
              success: function(reponsePHP){
                  that.closest('.todo').toggleClass('completed');
                  //je lance le countRest pr màj le footer
                  countRest();

              }
            });
  });


  //---------------------edit task --------------------------
  //Editer une tache de la liste
  //un seul edit se fait à la fois:
  //    -attribuer une classe edited pour le label ou le changement est en cours
  //    -enlever le edited quand on perd le focus


    $('body').on('dblclick', 'li:not(.completed) label:not(.edited) ',function(){
            $(this).addClass('edited');
             var content = $(this).html();
             var code = '<input type="text" />';
             $(this).html(code).find('input').val(content).focus();
            });


	//!!!!!!!Prob non résolu : 
			 //l'edit de la première tache ajoutée = blur ou change (ko)
			 // si j'actualise la page l'edit est bon 
			 //si j'ajoute plusieurs taches => edit 1 ere (ko)/ mais  le reste des taches l'edit est fonctionnel 
			 
    $('li label')
            // on perd le focus si on appuye sur "enter"
            .on('keyup','input',function(e){
               if (e.keyCode === 13){
                 $(this).blur();
               }
             })

             // on perd le focus si on appuye sur "Escape"
             .on('keyup','input',function(e){
                if (e.keyCode === 27){
                  $(this).blur();
                }
              })

              //on valide et on perd le focus en cas de changement
            .on('change','input ',function(){
                var that = $(this);

                $.ajax({
                  url:'tasks/edit/'+ $(this).closest('li').attr('data-id'),
                  data:{
                    content:$(this).val()
                        },
                  method:'post',
                  success: function(reponsePHP){
                    that.blur();
                        }
                });
              })
              .on('blur', 'input', function(){
                  $(this).closest('label').removeClass('edited')
                                          .html($(this).val());
                  });



  //---------------------Delet all finishedTasks--------------------------
  //Supprimer toute les taches terminées

  $('body').on('click' ,'footer .clear-completed',function(){

              $.ajax({
                url:'tasks/deleteFinished',
                success: function(reponsePHP){
                  $('.todo-list').find('.completed').remove();
                }

              });

  });


  //---------------------function actives restantes--------------------------
  //Fonction pour compter le nombre de taches active restante

  function countRest(){
      var code = $('.todo-list').find('li:not(.completed)').length;
      $('footer .todo-count').find('strong').html(code);
  }

  //---------------------filtres taches--------------------------
  //Activation des filtres du footer all / active / completed

  //Afficher toute les taches
  $('body').on('click' ,'footer .all' ,function(){
              $('.todo-list li').show();
  });


  //Afficher toute les taches "en cours"
  $('body').on('click' ,'footer .active' ,function(){
              $('.todo-list').find('li:not(.completed)').show();
              $('.todo-list').find('.completed').hide();
  });


  //Afficher toute les taches "terminées"
  $('body').on('click' ,'footer .completed' ,function(){
              $('.todo-list').find('.completed').show();
              $('.todo-list').find('li:not(.completed)').hide();
  });


});
