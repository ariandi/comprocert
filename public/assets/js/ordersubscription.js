$(document).ready(function(){

		$('.tanggalan').datepicker({
				autoclose: true,
				orientation: 'bottom',
				format: 'yyyy-mm-dd'
		});


		$(document).on("click", ".add-newline", function(){
	      var targettable = $(this).attr("target");
	      var actions = $(".tableline td:last-child").html();
	      var date=new Date();
	      var months=["JAN","FEB","MAR","APR","MAY","JUN","JUL","AUG","SEP","OCT","NOV","DEC"];
	      var val=date.getDate()+" "+months[date.getMonth()]+" "+date.getFullYear();
	      var titles = $(this).attr('title');
	      var active = $(this).attr('active');
	      //$(this).attr("disabled", "disabled");
	      var nomor =$(targettable+' tr').length * 10;
	      var minNumber = 1; // le minimum
          var maxNumber = 100; // le maximum
          var randomnumber = Math.floor(Math.random() * (maxNumber + 1) + minNumber);
	      var index = $(targettable+" tbody tr:last-child").index();
	      var row = '<tr>' +
	          	'<td>' + 
	          	'<input type="hidden" value="" class="form-control caridata" name="id[]" nomor="'+randomnumber+'" id="id'+randomnumber+'}">'+
	          	'<input type="hidden" value="'+randomnumber+'" class="form-control caridata" name="linenum[]" nomor="'+randomnumber+'" id="linenum'+randomnumber+'">'+
	          		nomor+
	          	'</td>' +
	          	'<td><input type="text" class="form-control caridata" name="productname[]" nomor="'+randomnumber+'" id="name'+randomnumber+'">' +
	          	'    <input type="hidden" id="productid'+randomnumber+'" value="'+titles+'" nomor="'+randomnumber+'" class="form-control" name="productid[]"></td>' +
	          	'<td><input type="text" class="form-control caridata" size="2" nomor="'+randomnumber+'" name="ordered[]" id="ordered'+randomnumber+'"></td>' +
	          	'<td><input type="text" class="form-control caridata" size="2" nomor="'+randomnumber+'" name="delivered[]" id="delivered'+randomnumber+'"></td>' +
	          	'<td><input type="text" class="form-control caridata" size="2" name="costprice[]" nomor="'+randomnumber+'" id="costprice'+randomnumber+'"></td>' +
	          	'<td><input type="text" class="form-control caridata" size="2" name="custprice[]" nomor="'+randomnumber+'" id="custprice'+randomnumber+'"></td>' +
	          	'<td><input type="text" class="form-control caridata" size="2" name="discount[]" nomor="'+randomnumber+'" id="discount'+randomnumber+'"></td>' +
	          	'<td>'+
	          		'<input type="hidden" class="form-control caridata" size="2" name="vat[]" nomor="'+randomnumber+'" id="vat'+randomnumber+'">'+
	          		'<span id="vattext'+randomnumber+'">0%</span>'+
	          	'</td>' +
	          	'<td>'+
	          		'<input type="hidden" class="form-control caridata" size="2" name="sum[]" nomor="'+randomnumber+'" id="sum'+randomnumber+'">'+
	          		'<span id="sumtext'+randomnumber+'">0</span></td>' +
	          	'<td> ' +
	          	'  <a class="deletetr btn btn-default" nomor="'+randomnumber+'" data-toggle="tooltip" id="deletenew" targets="'+targettable+'"><i class="fa fa-trash"></i></a></td>' +
	        '</tr>'+
	        '<tr class="dtln'+randomnumber+'">'+
	        '	<td>Available from</td>'+
	        '	<td colspan="3">'+
	        '		<div class="input-group date">'+
						'<div class="input-group-addon">'+
					    	'<i class="fa fa-calendar"></i>'+
					    '</div>'+
					    '<input type="text" class="form-control pull-right tanggall" id="availablefrom" placeholder="Available From" readonly name="availablefrom[]" value="">'+
				    '</div>'+
	        '	</td>'+
	        '	<td>Available to</td>'+
	        '	<td colspan="3">'+
	        '		<div class="input-group date">'+
						'<div class="input-group-addon">'+
					    	'<i class="fa fa-calendar"></i>'+
					    '</div>'+
					    '<input type="text" class="form-control pull-right tanggall" id="availableto" placeholder="Available To" readonly name="availableto[]" value="">'+
				    '</div>'+
	        '	</td>'+
	        '	<td></td>'+
	        '</tr>'+
	        '<tr class="dtln'+randomnumber+'">'+
	        '	<td>Comment</td>'+
	        '	<td colspan="7">'+
	        '		<input type="text" name="commentline[]" id="commentline'+randomnumber+'" nomor="'+randomnumber+'" value="" class="form-control" />'+
						
	        '	</td>'+
	        '	<td></td>'+
	        '</tr>'+
	        '';

	      $(targettable).append(row);
	      $(targettable+" tbody tr").eq(index + 1).find(".addtr, .edittr").toggle();
	      $('[data-toggle="tooltip"]').tooltip();
	    });

		$(document).on("click", ".tanggall", function(){
			$(this).datepicker({
				autoclose: true,
				orientation: 'bottom',
				format: 'yyyy-mm-dd'
			}).focus();

			$(this).removeClass('tanggall');
		});

	    $("body").on("click", ".deletetr", function(){
	        var node = $(this).attr('node');
	        var id = $(this).attr('id');
	        var nomor = $(this).attr('nomor');
	        var targettable = $(this).attr('targets');
	        var link = $(this).attr('href');
	        
	        if(link){
	        	 if (confirm('Are you sure to delete?')) {
	        	 	return true;
	        	 }else{
	        	 	return false;
	        	 }
	        	 
	        }else{
	        	$(this).parents("tr").remove();
		        $(targettable).find('.dtln'+nomor).remove();
	          	$(".add-new").removeAttr("disabled");
	        }

	        
	    });


	    
	    $("body").on("keyup", ".caridata", function(){

	        var id = $(this).attr('id');
	        var nomor = $(this).attr('nomor');
	        if(id == "namecompany"){
	        	var projects = company;
	        }else if(id == "nameperson"){
	        	var projects = person;
	        }else{
	        	var projects = dataprod;
	        }
	        
	        
	        if(id == "name"+nomor){

			    $( "#"+id ).autocomplete({
			      minLength: 0,
			      source: function(request, response) {
				        var results = $.ui.autocomplete.filter(projects, request.term);
				        response(results.slice(0, 15));
				  },
			      focus: function( event, ui ) {
			        //$( this ).val( ui.item.value );
			        return false;
			      },
			      select: function( event, ui ) {
			      	if(id != "namecompany" && id != "nameperson"){

				        $( this ).val( ui.item.ProductName );
				        $( '#productid'+nomor ).val( ui.item.id );
				 		$('#custprice'+nomor).val(ui.item.UnitCustPrice);
				 		$('#costprice'+nomor).val(ui.item.UnitCostPrice);
				 		$('#vattext'+nomor).html(ui.item.VatID+"%");
				 		
				 		$('#discount'+nomor).val("0");

				 		if($('#ordered'+nomor).val()){

							if($('#discount'+nomor).val() != '' ){
								var totalharga = $('#ordered'+nomor).val() * $('#custprice'+nomor).val();
								var totaldiskon = ($('#discount'+nomor).val() * ($('#ordered'+nomor).val() * $('#custprice'+nomor).val())) / 100;
								var total = totalharga - totaldiskon;
								$('#sumtext'+nomor).html(total);
							}else{
								var total = $('#ordered'+nomor).val() * $('#custprice'+nomor).val();
								$('#sumtext'+nomor).html(total);
							}

				 		}else{
				 			$('#ordered'+nomor).val("0");
				 			$('#delivered'+nomor).val("0");
				 		}
				 	}else if(id == "namecompany"){
				 		$( this ).val( ui.item.CompanyName );
				 		$('#personid').val("0");
				 		$('#companyid').val(ui.item.desc);
				 		$('#iname').val(ui.item.CompanyName); $('#dname').val(ui.item.CompanyName);
				 		$('#iemail').val(ui.item.Email); $('#demail').val(ui.item.Email);
				 		$('#iaddress').val(ui.item.address1); $('#daddress').val(ui.item.address1);
				 		$('#iplace').val(ui.item.address2); $('#dplace').val(ui.item.address2);
				 		//$('#ipostcode').val(); $('#dpostcode').val();
				 		$('#icountry').val("-"); $('#dcountry').val("-");
				 	}else if(id == "nameperson"){
				 		$( this ).val( ui.item.first_name+" "+ui.item.last_name );
				 		
				 		$('#companyid').val(0);
				 		$('#personid').val(ui.item.desc);
				 		$('#iname').val(ui.item.first_name+" "+ui.item.last_name); $('#dname').val(ui.item.first_name+" "+ui.item.last_name);
				 		$('#iemail').val(ui.item.email); $('#demail').val(ui.item.email);
				 	}
			        return false;
			      }
			    })
			    .autocomplete( "instance" )._renderItem = function( ul, item ) {
			    	if(id != "namecompany" && id != "nameperson"){
				      return $( "<li style ='cursor:pointer; border-bottom: 1px solid #000; background: #d0c0c0;width: 20%;list-style: none;position: relative;left: -40px;padding-left: 10px'>" )
				        .append( "<div>" + item.ProductName + "</div>" )
				        .appendTo( ul );
				   	}else if(id == "nameperson"){
				      return $( "<li style ='cursor:pointer; border-bottom: 1px solid #000; background: #d0c0c0;width: 20%;list-style: none;position: relative;left: -40px;padding-left: 10px'>" )
				        .append( "<div>" + item.first_name +" "+item.last_name+ "</div>" )
				        .appendTo( ul );
				   	}else if (id == "namecompany"){
				   		 return $( "<li style ='cursor:pointer;border-bottom: 1px solid #000; background: #d0c0c0;width: 20%;list-style: none;position: relative;left: -40px;padding-left: 10px'>" )
				        .append( "<div>" + item.CompanyName + "</div>" )
				        .appendTo( ul );
				   	}
			    };
			}

			if( id == "ordered"+nomor ){
				var total = $('#ordered'+nomor).val() * $('#custprice'+nomor).val();
				$('#delivered'+nomor).val($('#ordered'+nomor).val());
				$('#sumtext'+nomor).html(total);
			}

			if( id == "discount"+nomor ){
				if($(this).val() != '' ){
					var totalharga = $('#ordered'+nomor).val() * $('#custprice'+nomor).val();
					var totaldiskon = ($(this).val() * ($('#ordered'+nomor).val() * $('#custprice'+nomor).val())) / 100;
					var total = totalharga - totaldiskon;
					$('#sumtext'+nomor).html(total);
				}else{
					var total = $('#ordered'+nomor).val() * $('#custprice'+nomor).val();
					$('#sumtext'+nomor).html(total);
				}
				
			}
	    });
	    
	});