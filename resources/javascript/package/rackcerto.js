var oRackcerto = {
        
        setCategoria: function(sCategoria){
            
            $('#load-racks').hide();
            $('#inner-selecao').hide()
            $("#categorias").hide("slow");
            $("#selected").show("slow");
            var innerCategoria = "";
            
            if(sCategoria == 1){
                innerCategoria = "Rack e Bagageiros";
                
                $('#rackcerto').show();
                $('.remover').show("slow");
                $('#suporte-bicicletas').hide();
                $("#equipamentos-aquaticos").hide();
                $("#bagageiros").hide();
                
                $('#info-veiculo').show();
                $('#select-marca').show();
            }
            
            if(sCategoria == 2){
                innerCategoria = "Suporte p/ Biciclietas";
                
                $('#suporte-bicicletas').show();
                $('.remover').show();
            }
            
            if(sCategoria == 3){
                innerCategoria = "Suporte p/ Equipamentos Aquáticos";
                $(".remover").show("slow");
                
                $("#equipamentos-aquaticos").show();
            }
            
            if(sCategoria == 4){
                innerCategoria = "Bagageiro";
                $(".remover").show("slow");
                
                $("#bagageiros").show();
            }
            
            $("#selected").html(innerCategoria);
            $('input:radio').attr('checked', false);
            $('select').val("");
            
            $.ajax({
                url: _globalEnderecoNormal+"rackcerto/rackcerto.php", 
                type: "post",
                dataType: "html",
                data: "categoria="+sCategoria+"&xhr=<?echo time()?>&fn=setCategoria",
                success:function(strData){
                    eval(strData);
                }
            });
                
        },

        setMarca: function(sMarca){
            
            $('#select-marca').hide();
            $("#info-selected").show(); 
            $('#selected-marca').show(); 
            $('#inner-marca').html(sMarca); 
            $('#marca-value').val(sMarca); 
            
            $.ajax({
                url: _globalEnderecoNormal+"rackcerto/rackcerto.php", 
                type: "post",
                dataType: "html",
                data: "marca="+sMarca+"&xhr=<?echo time()?>&fn=loadModelo",
                success:function(strData){
                    eval(strData);
                }
            });
        },
        
        setModelo: function(sModelo){
            
            $('#select-modelo').hide();
            $('#selected-modelo').show(); 
            $('#inner-modelo').html(sModelo); 
            $('#modelo-value').val(sModelo);

            $.ajax({
                url: _globalEnderecoNormal+"rackcerto/rackcerto.php", 
                type: "post",
                dataType: "html",
                data: "marca="+$('#marca-value').val()+"&modelo="+sModelo+"&xhr=<?echo time()?>&fn=loadVeiculo",
                success:function(strData){
                    eval(strData);
                }
            });
        },
        
        setVeiculo: function(sVeiculo){
        
            $('#select-veiculo').hide();
            $('#selected-veiculo').show(); 
            $('#inner-veiculo').html(sVeiculo);
            $('#veiculo-value').val(sVeiculo);

            $.ajax({
                url: _globalEnderecoNormal+"rackcerto/rackcerto.php", 
                type: "post",
                dataType: "html",
                data: "marca="+$('#marca-value').val()+"&modelo="+$('#modelo-value').val()+"&veiculo="+sVeiculo+"&xhr=<?echo time()?>&fn=loadAno",
                success:function(strData){
                    eval(strData);
                }
            });
        },
        
        setAno: function(sAno){
            
            $('#select-ano').hide();
            $('#selected-ano').show(); 
            $('#inner-ano').html(sAno); 
            $('#ano-value').val(sAno);
            
            $.ajax({
                url: _globalEnderecoNormal+"rackcerto/rackcerto.php", 
                type: "post",
                dataType: "html",
                data: "marca="+$('#marca-value').val()+"&modelo="+$('#modelo-value').val()+"&veilulo="+$('#veiculo-value').val()+"&ano="+sAno+"&xhr=<?echo time()?>&fn=loadRacks",
                success:function(strData){
                    eval(strData);
                }
            });
        },

        removeCategoria: function(){
            
            $("#selected").hide("slow");
            $(".remover").hide("slow");
            
            $("#rackcerto").hide("slow");
            $("#suporte-bicicletas").hide("slow");
            $("#equipamentos-aquaticos").hide("slow");
            $("#bagageiros").hide("slow");
            
            $("#categorias").show("slow");
            this.removeMarca(true);
        },
        
        removeMarca: function(bCascate){
            
            $('#selected-marca').hide();
            $('#select-modelo').hide();
            
            if(!bCascate){
                $('#select-marca').show("slow");
            }

            this.removeModelo(true);
        },
        
        removeModelo: function(bCascate){
            
            $('#selected-modelo').hide("slow");
            $('#select-veiculo').hide();
            
            if(!bCascate){
                $('#select-modelo').show();
            }
            
            this.removeVeiculo(true);
        },

        removeVeiculo: function(bCascate){
            
            $('#selected-veiculo').hide("slow");
            $('#select-ano').hide();
            
            if(!bCascate){
                $('#select-veiculo').show();
            }
            
            this.removeAno(true);
        },

        removeAno: function(bCascate){
            
            $('#selected-ano').hide("slow");
            $('#load-racks').hide();
            
            if(!bCascate){
                $('#select-ano').show();
            }
            $('select').val("");
        },
        
        //----------------------------------------------------------------------
        // Bike
        //----------------------------------------------------------------------
        
        loadSuportesBicicletas: function(sTipo){
            
            $('#suporte-selected').html(sTipo);
            $('#suporte-selected').show(sTipo);
            $(".suporte-remover").show("slow");
            $(".descricao").hide();
            
            $.ajax({
                url: _globalEnderecoNormal+"rackcerto/rackcerto.php", 
                type: "post",
                dataType: "html",
                data: "tipo="+sTipo+"&xhr=<?echo time()?>&fn=loadSuportesBicicletas",
                success:function(strData){
                    eval(strData);
                }
            });
        },
        
        removeSuporte: function(sTipo){
           
           $('#load-suportes').hide(sTipo);
           $('#suporte-selected').hide("slow");
           $('.suporte-remover').hide("slow");
           $("#pergunta-teto").hide();
           $(".whatIsRack").hide();
           $("#clique-aqui").hide();
           $(".descricao").show();
           
           $('input:radio').attr('checked', false);
       
        },
        
        //----------------------------------------------------------------------
        // Suportes
        //----------------------------------------------------------------------
            
        loadSuportes: function(sTipo){
            
            $('.radio-no').attr('checked',false);
            
            $.ajax({
                url: _globalEnderecoNormal+"rackcerto/rackcerto.php", 
                type: "post",
                dataType: "html",
                data: "tipo="+sTipo+"&xhr=<?echo time()?>&fn=loadSuportes",
                success:function(strData){
                    eval(strData);
                }
            });
        },
        
        // ---------------------------------------------------------------------
        // CARREGA UMA SELEÇÃO ESPECÍFICA
        // ---------------------------------------------------------------------
        
        loadSelecao: function(iCodselecao){
            
            $('.radio-no').attr('checked',false);
            
            $.ajax({
                url: _globalEnderecoNormal+"rackcerto/rackcerto.php", 
                type: "post",
                dataType: "html",
                data: "codselecao="+iCodselecao+"&xhr=<?echo time()?>&fn=loadSelecao",
                success:function(strData){
                    eval(strData);
                }
            });
        },
        
        //----------------------------------------------------------------------
        // Carrinho
        //----------------------------------------------------------------------
            
        setCarrinho: function(sTamcor){
            
            $.ajax({
                url: _globalEnderecoNormal+"rackcerto/rackcerto.php", 
                type: "post",
                dataType: "html",
                data: "p1="+sTamcor+"&xhr=<?echo time()?>&fn=setCarrinho",
                success:function(){
                    document.location.href=_globalEnderecoNormal+'carrinho/';
                    /*window.open(_globalEnderecoNormal+'carrinho/', '_blank');*/ 
                }
            });
        }

    }