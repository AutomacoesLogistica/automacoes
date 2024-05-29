<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>Gerdau :: GAGF - Bruno Gonçalves</title>
<link rel="shortcut icon" type="imagem/JPG" href="./images/gerdau.jpg";  id="favicon">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link href="./video/video-js.css" rel="stylesheet">


<script src="./video/video.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>
<div id=tabela>
<input type="text" id="data2" value="vazio" hidden="hidden"/>
<input type="text" id="ref1" name="ref1" value="vazio" hidden="hidden"/>
<img id='btn_calendario' src="./images/date_range.png" onclick="clicou_exibir_calendario();"/>

<div id='dados'>
<label id='valor_registro'><b>Registro: </b></label>
<input type='text' id='v_registro' name='v_registro' value='--'/>
<label id='valor_nome'><b>Nome: </b></label>
<input type='text' id='v_nome' name='v_nome' value='--'/>
<label id='lb_valor_parecer'><b>Parecer: </b></label>
<textarea id='v_parecer' name='v_parecer' name="Text1" cols="48" rows="4">--</textarea>
</div>

<label id='info_eventos'>Eventos Detectados: 0 </label>
<label id='info_eventos2'>Eventos justitificados: 0 </label>
<label id='info_eventos3'>Aderência: 0% </label>
<?php
date_default_timezone_set('America/Sao_Paulo');

$mensagem  = isset($_GET['data'])?$_GET['data']:"vazio";

if($mensagem == "vazio")
{
 $data = date('d/m/Y');
}
 $data = $mensagem;

$mes = substr($data,3,2);
?>
<label id='titulo'> VA Cheio/Vazio MB - Detecções realizadas em <?php print $data ?></label>
<label id='titulo2'> Ultima detecção: 16/08/2021</label>

     <table>
        
        <tbody>
            <?php
            $text = '';
            $url_do_arquivo = '';
            $foto = '';
            $registro = '';
            $nome = '';
            $justificativa = '';
            $primeira_url = "";
            $avaliado = 'NAO';
            $encontrado = 0;
            $hora_evento = '';
            $evento_justificado = 0;
            //$hora = date('H:i:s');
            include_once 'conexao_sva.php';
            $sql = $dbcon->query("SELECT * FROM cheio_vazio WHERE data_leitura='$data' AND deteccao_falsa != 'SIM' ORDER BY id DESC");
            if(mysqli_num_rows($sql)>0)
            {
             while($dados = $sql->fetch_array())
             {

              $status_evento = $dados['text'];
              $hora_evento = $dados['hora'];
              $data_evento = $dados['data_leitura'];
              $cam = $dados['camera_id'];
              if($status_evento == 'Detect - Cheio'){$status_evento = 'Detectado Cheio';}
              else if($status_evento == 'Detect - Vazio'){$status_evento = 'Detectado Vazio';}

              //Atualiza a camera detectada
              if($cam == 'ms0742-cam00'){$cam = 'Câmera Entrada ROM';}
              else if ($cam == 'ms0742-cam01'){$cam = 'Câmera Saida ROM';}
              else if ($cam == 'ms0742-cam05'){$cam = 'Câmera Saida ROM';}
              else if ($cam == 'ms0742-cam02'){$cam = 'Câmera Saida Alt. ROM';}
              $url_do_arquivo = $dados['caminho'];
              $foto = $dados['imagem'];
              $avaliado = $ados['justificado'];
              $justificado = $dados['justificado'];    
              $registro = $dados['registro'];
              $id = $dados['id'];
              $nome = $dados['nome'];
              $justificativa = $dados['justificativa'];
              $url_video = $url_do_arquivo;
               $encontrado = $encontrado+1; 
              
              if($encontrado == 1)
              {
               $primeira_url = $url_video; 
               ?>
                <script>
                

                if('<?php print $justificado?>' == "NAO" || '<?php print $justificado?>'=="")
                {
                 document.getElementById('v_registro').value = "--";
                 document.getElementById('v_nome').value = "--";
                 document.getElementById('v_parecer').value = "Ainda não realizado ajustificativa";
                }
                else
                {
                 document.getElementById('v_registro').value = '<?php print $registro ?>';
                 document.getElementById('v_nome').value = '<?php print $nome ?>';
                 document.getElementById('v_parecer').value = '<?php print $justificativa ?>';
                }
                </script>
              <?php
              }
              else{
                $id = $dados['id'];
                
              }   
              ?>
              <tr>
                <td class="th1">
                  <div id='foto'>
                      <img id='foto' src="data:image/jpeg;base64,<?php print $foto ?>";/>
                      <label><b>Data Evento: </b> <?php print $data_evento ?></label>
                      </br>
                      <label><b>Horario Evento: </b> <?php print $hora_evento ?></label>
                      </br>
                      <label><b>Status Evento: </b><?php print $status_evento?></label>
                      </br>
                      <label><b>Câmera: </b><?php print $cam ?></label>
                      </br>
                      <a href="javascript:altera_video('<?php echo $url_do_arquivo ?>');" id='assistir'>Assistir</a>
                      <?php
                      if($justificado == "SIM")
                      {
                        $evento_justificado = $evento_justificado+1;  
                          //COLOCA NA COR VERDE #228B22
                       ?> 
                       <a href="javascript:altera_justificar('<?php echo $id ?>');" style="background-color:#228B22;"  id='justificar' name='justificar'>Parecer Video</a>
                       <script>
                       //alert('verde');
                       </script>
                       <?php
                      }
                      else{
                          //COLOCA NA COR VERMELHO #DC143C;
                      ?>
                      <a href="javascript:altera_justificar('<?php echo $id ?>');" style="background-color:#DC143C;"  id='justificar' name='justificar'>Parecer Video</a>
                      <script>
                       //alert('vermelho');
                       </script>
                      <?php
                      }
                      ?>
                      <a href="javascript:deteccao_falsa('<?php echo $id ?>');" id='ignorar' name='ignorar'>Detecção Falsa</a>
                      
                  </div>

                
                  

                </td>
           
              </tr>
             <?php
             }// Fecha o while 
             ?>
             <script>
                n_encontrado = '<?php print $encontrado ?>';
                n_justificado = '<?php print $evento_justificado ?>';
                n_aderencia = (n_justificado/n_encontrado * 100).toFixed(1) + "%";
                //alert(n_justificado);
                document.getElementById('info_eventos').innerHTML = 'Eventos Detectados : '+ n_encontrado;
                document.getElementById('info_eventos2').innerHTML = 'Eventos Justificados : '+ n_justificado; 
                document.getElementById('info_eventos3').innerHTML = 'Aderência : '+ n_aderencia; 
              </script>
             <?php
            } // Fecha o if mysqli_num_rows($sql)>0
            if($encontrado==0)
             {
              //INFORMA QUE NÃO ENCONTROU EVENTOS
              ?>   
              <tr>
                <td class="th1">
                </br>
                  <label><b>&nbsp&nbsp Não existe eventos para esta data! </b></label>
                  
                </td>
              </tr>
              

              <?php   
             }
            ?>
            
        </tbody>
    </table>



<!-- HTML -->
<div id='player1'> 
<video id='vplayer1'  class="video-js vjs-default-skin"  controls autoplay>
<source type="application/x-mpegURL" src="<?php print $primeira_url?>">
</video>
</div>
<script>
altera_video('<?php echo $primeira_url ?>');
var player = videojs('vplayer1');
player.play();

</script>











</div> <!-- Fecha a div tabela-->


<div id='div_calendario' class="app-container" ng-app="dateTimeApp" ng-controller="dateTimeCtrl as ctrl" ng-cloak>
		
        <div date-picker
             datepicker-title="Selecione a data desejada"
             picktime="true"
             pickdate="true"
             pickpast="true"
             mondayfirst="true"
             custom-message="Você selecionou"
             selecteddate="ctrl.selected_date"
             updatefn="ctrl.updateDate(newdate)">
             
            <div class="datepicker"
                 ng-class="{
                    'am': timeframe == 'am',
                    'pm': timeframe == 'pm',
                    'compact': compact
                }">
                <div class="datepicker-header">
                    <div class="datepicker-title" ng-if="datepicker_title">{{ datepickerTitle }}</div>
                    <div class="datepicker-subheader" id="data">{{ customMessage }} {{ selectedDay }}, {{ localdate.getDate() }} de {{ monthNames[localdate.getMonth()] }} de {{ localdate.getFullYear() }}</div>
                </div>
                <div class="datepicker-calendar">
                    <div class="calendar-header">
                        <div class="goback" ng-click="moveBack()" ng-if="pickdate">
                            <svg width="30" height="30">
                                <path fill="none" stroke="#1C1C1C" stroke-width="3" d="M19,6 l-9,9 l9,9"/>
                            </svg>
                        </div>
                        <div class="current-month-container">{{ currentViewDate.getFullYear() }} {{ currentMonthName() }}</div>
                        <div class="goforward" ng-click="moveForward()" ng-if="pickdate">
                            <svg width="30" height="30">
                                <path fill="none" stroke="#1C1C1C" stroke-width="3" d="M11,6 l9,9 l-9,9" />
                            </svg>
                        </div>
                    </div>
                    <div class="calendar-day-header">
                        <span ng-repeat="day in days" class="day-label">{{ day.short }}</span>
                    </div>
                    <div class="calendar-grid" ng-class="{false: 'no-hover'}[pickdate]">
                        <div
                            ng-class="{'no-hover': !day.showday}"
                            ng-repeat="day in month"
                            class="datecontainer"
                            ng-style="{'margin-left': calcOffset(day, $index)}"
                            track by $index>
                            <div class="datenumber" ng-class="{'day-selected': day.selected }" ng-click="selectDate(day)">
                                {{ day.daydate }}
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="timepicker" ng-if="picktime == 'true'">
                    <div ng-class="{'am': timeframe == 'am', 'pm': timeframe == 'pm' }">
                        <div class="timepicker-container-outer" selectedtime="time" timetravel>
                            <div class="timepicker-container-inner">
                                <div class="timeline-container" ng-mousedown="timeSelectStart($event)" sm-touchstart="timeSelectStart($event)">
                                    <div class="current-time">
                                        <div class="actual-time">{{ time }}</div>
                                    </div>
                                    <div class="timeline">
                                    </div>
                                    <div class="hours-container">
                                        <div class="hour-mark" ng-repeat="hour in getHours() track by $index"></div>
                                    </div>
                                </div>
                                <div class="display-time">
                                    <div class="decrement-time" ng-click="adjustTime('decrease')">
                                        <svg width="24" height="24">
                                            <path stroke="white" stroke-width="2" d="M8,12 h8"/>
                                        </svg>
                                    </div>
                                    <div class="time" ng-class="{'time-active': edittime.active}">
                                        <input type="text" class="time-input" ng-model="edittime.input" ng-keydown="changeInputTime($event)" ng-focus="edittime.active = true; edittime.digits = [];" ng-blur="edittime.active = false"/>
                                        <div class="formatted-time">{{ edittime.formatted }}</div>
                                    </div>
                                    <div class="increment-time" ng-click="adjustTime('increase')">
                                        <svg width="24" height="24">
                                            <path stroke="white" stroke-width="2" d="M12,7 v10 M7,12 h10"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="am-pm-container">
                                    <div class="am-pm-button" ng-click="changetime('am');">am</div>
                                    <div class="am-pm-button" ng-click="changetime('pm');">pm</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="buttons-container">
                    <div class="cancel-button"onclick="clicou_cancelar();">Cancelar</div>
                    <div class="save-button"onclick="clicou_selecionar();">Selecionar </div>
                </div>
                
            </div>
        </div>
    </div>


    <script src='calendario/js/b.js'></script>
<script src='calendario/js/c.js'></script>

<script>
    var app = angular.module('dateTimeApp', []);

app.controller('dateTimeCtrl', function ($scope) {
	var ctrl = this;
	
	ctrl.selected_date = new Date();
	ctrl.selected_date.setHours(10);
	ctrl.selected_date.setMinutes(0);
	
	ctrl.updateDate = function (newdate) {
		
		// Do something with the returned date here.
		
		//console.log(newdate);
	};
});



// Date Picker
app.directive('datePicker', function ($timeout, $window) {
    
    return {
        restrict: 'AE',
        scope: {
            selecteddate: "=",
            updatefn: "&",
            open: "=",
            datepickerTitle: "@",
            customMessage: "@",
            picktime: "@",
            pickdate: "@",
            pickpast: '=',
			mondayfirst: '@'
        },
		transclude: true,
        link: function (scope, element, attrs, ctrl, transclude) {
			transclude(scope, function(clone, scope) {
				element.append(clone);
			});
			
            if (!scope.selecteddate) {
                scope.selecteddate = new Date();
            }

            if (attrs.datepickerTitle) {
                scope.datepicker_title = attrs.datepickerTitle;
            }

            scope.days = [
                { "long":"Domingo","short":"Dom" },
                { "long":"Segunda","short":"Seg" },
                { "long":"Terça","short":"Ter" },
                { "long":"Quarta","short":"Qua" },
                { "long":"Quinta","short":"Qui" },
                { "long":"Sexta","short":"Sex" },
                { "long":"Sabado","short":"Sab" },
            ];
			if (scope.mondayfirst == 'true') {
				var sunday = scope.days[0];
				scope.days.shift();
				scope.days.push(sunday);
			}

            scope.monthNames = [
                "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
            ];

            function getSelected() {
                if (scope.currentViewDate.getMonth() == scope.localdate.getMonth()) {
                    if (scope.currentViewDate.getFullYear() == scope.localdate.getFullYear()) {
                        for (var number in scope.month) {
                            if (scope.month[number].daydate == scope.localdate.getDate()) {
                                scope.month[number].selected = true;
								if (scope.mondayfirst == 'true') {
									if (parseInt(number) === 0) {
										number = 6;
									} else {
										number = number - 1;
									}
								}
								scope.selectedDay = scope.days[scope.month[number].dayname].long;
							}
                        }
                    }
                }
            }

            function getDaysInMonth() {
                var month = scope.currentViewDate.getMonth();
                var date = new Date(scope.currentViewDate.getFullYear(), month, 1);
                var days = [];
                var today = new Date();
                while (date.getMonth() === month) {
                    var showday = true;
                    if (!scope.pickpast && date < today) {
                        showday = false;
                    }
                    if (today.getDate() == date.getDate() &&
                        today.getYear() == date.getYear() &&
                        today.getMonth() == date.getMonth()) {
                        showday = true;
                    }
                    var day = new Date(date);
                    var dayname = day.getDay();
                    var daydate = day.getDate();
                    days.push({ 'dayname': dayname, 'daydate': daydate, 'showday': showday });
                    date.setDate(date.getDate() + 1);
                }
                scope.month = days;
                
            }

            function initializeDate() {
                scope.currentViewDate = new Date(scope.localdate);
                scope.currentMonthName = function () {
                    return scope.monthNames[scope.currentViewDate.getMonth()];
                };
                getDaysInMonth();
                getSelected();
            }

            // Takes selected time and date and combines them into a date object
            function getDateAndTime(localdate) {
                var time = scope.time.split(':');
                if (scope.timeframe == 'am' && time[0] == '12') {
                    time[0] = 0;
                } else if (scope.timeframe == 'pm' && time[0] !== '12') {
                    time[0] = parseInt(time[0]) + 12;
                }
                return new Date(localdate.getFullYear(), localdate.getMonth(), localdate.getDate(), time[0], time[1]);                
            }

            // Convert to UTC to account for different time zones
            function convertToUTC(localdate) {
                var date_obj = getDateAndTime(localdate);
                var utcdate = new Date(date_obj.getUTCFullYear(), date_obj.getUTCMonth(), date_obj.getUTCDate(), date_obj.getUTCHours(), date_obj.getUTCMinutes());
                return utcdate;
            }
            // Convert from UTC to account for different time zones
            function convertFromUTC(utcdate) {
                localdate = new Date(utcdate);
                return localdate;
            }

            // Returns the format of time desired for the scheduler, Also I set the am/pm
            function formatAMPM(date) {
                
                var hours = date.getHours();
                var minutes = date.getMinutes();
                hours >= 12 ? scope.changetime('pm') : scope.changetime('am');
                hours = hours % 12;
                hours = hours ? hours : 12; // the hour '0' should be '12'
                minutes = minutes < 10 ? '0' + minutes : minutes;
                var strTime = hours + ':' + minutes;
                return strTime;
            }
			
            scope.$watch('open', function() {
                if (scope.selecteddate !== undefined && scope.selecteddate !== null) {
                    scope.localdate = convertFromUTC(scope.selecteddate);
                } else {
                    scope.localdate = new Date();
                    scope.localdate.setMinutes(Math.round(scope.localdate.getMinutes() / 60) * 30);
                }
				scope.time = formatAMPM(scope.localdate);
				scope.setTimeBar(scope.localdate);
				initializeDate();
				scope.updateInputTime();
            });

            scope.selectDate = function (day) {
                
                if (scope.pickdate == "true" && day.showday) {
                    for (var number in scope.month) {
                        var item = scope.month[number];
                        if (item.selected === true) {
                            item.selected = false;
                        }
                    }
                    day.selected = true;
                    scope.selectedDay = scope.days[day.dayname].long;
                    scope.localdate = new Date(scope.currentViewDate.getFullYear(), scope.currentViewDate.getMonth(), day.daydate);
                    //alert(scope.localdate); //Exibe a data selecionada
                    initializeDate(scope.localdate);
                    scope.updateDate();
                }
            };

            scope.updateDate = function () {
                if (scope.localdate) {
                    var newdate = getDateAndTime(scope.localdate);
                    scope.updatefn({newdate:newdate});
                   
                }
            };

            scope.moveForward = function () {
                scope.currentViewDate.setMonth(scope.currentViewDate.getMonth() + 1);
                if (scope.currentViewDate.getMonth() == 12) {
                    scope.currentViewDate.setDate(scope.currentViewDate.getFullYear() + 1, 0, 1);
                }
                getDaysInMonth();
                getSelected();
            };

            scope.moveBack = function () {
                scope.currentViewDate.setMonth(scope.currentViewDate.getMonth() - 1);
                if (scope.currentViewDate.getMonth() == -1) {
                    scope.currentViewDate.setDate(scope.currentViewDate.getFullYear() - 1, 0, 1);
                }
                getDaysInMonth();
                getSelected();
            };

            scope.calcOffset = function (day, index) {
                if (index === 0) {
                    var offset = (day.dayname * 14.2857142) + '%';
					if (scope.mondayfirst == 'true') {
						offset = ((day.dayname - 1) * 14.2857142) + '%';
					}
                    return offset;
                }
            };
            
			///////////////////////////////////////////////
			// Check size of parent element, apply class //
			///////////////////////////////////////////////
			scope.checkWidth = function (apply) {
				var parent_width = element.parent().width();
				if (parent_width < 620) {
					scope.compact = true;
				} else {
					scope.compact = false;
				}
				if (apply) {
					scope.$apply();
				}
			};
			scope.checkWidth(false);
			
            //////////////////////
            // Time Picker Code //
            //////////////////////
            if (scope.picktime) {
                var currenttime;
                var timeline;
                var timeline_width;
                var timeline_container;
                var sectionlength;

                scope.getHours = function () {
                    var hours = new Array(11);
                    return hours;
                };

                scope.time = "12:00";
                scope.hour = 12;
                scope.minutes = 0;
                scope.currentoffset = 0;

                scope.timeframe = 'am';

                scope.changetime = function(time) {
                    scope.timeframe = time;
                    scope.updateDate();
					scope.updateInputTime();					
                };
				
				scope.edittime = {
					digits: []
				};
				
				scope.updateInputTime = function () {
					scope.edittime.input = scope.time + ' ' + scope.timeframe;
					scope.edittime.formatted = scope.edittime.input;
				};
				
				scope.updateInputTime();
				
				function checkValidTime (number) {
					validity = true;
					switch (scope.edittime.digits.length) {
						case 0:
							if (number === 0) {
								validity = false;
							}
							break;
						case 1:
							if (number > 5) {
								validity = false;
							} else {
								validity = true;
							}
							break;
						case 2:
							validity = true;
							break;
						case 3:
							if (scope.edittime.digits[0] > 1) {
								validity = false;
							} else if (scope.edittime.digits[1] > 2) {
								validity = false;
							} else if (scope.edittime.digits[2] > 5) {
								validity = false;
							}
							else {
								validity = true;								
							}
							break;
						case 4:
							validity = false;
							break;
					}
					return validity;
				}
				
				function formatTime () {
					var time = "";
					if (scope.edittime.digits.length == 1) {
						time = "--:-" + scope.edittime.digits[0];
					} else if (scope.edittime.digits.length == 2) {
						time = "--:" + scope.edittime.digits[0] + scope.edittime.digits[1];
					} else if (scope.edittime.digits.length == 3) {
						time = "-" + scope.edittime.digits[0] + ':' + scope.edittime.digits[1] + scope.edittime.digits[2];
					} else if (scope.edittime.digits.length == 4) {
						time = scope.edittime.digits[0] + scope.edittime.digits[1].toString() + ':' + scope.edittime.digits[2] + scope.edittime.digits[3];
						console.log(time);
					}
					return time + ' ' + scope.timeframe;
				};
				
				scope.changeInputTime = function (event) {
					var numbers = {48:0,49:1,50:2,51:3,52:4,53:5,54:6,55:7,56:8,57:9};
					if (numbers[event.which] !== undefined) {
						if (checkValidTime(numbers[event.which])) {
							scope.edittime.digits.push(numbers[event.which]);
							console.log(scope.edittime.digits);
							scope.time_input = formatTime();
							scope.time = numbers[event.which] + ':00';
							scope.updateDate();
							scope.setTimeBar();
						}
					} else if (event.which == 65) {
						scope.timeframe = 'am';
						scope.time_input = scope.time + ' ' + scope.timeframe;
					} else if (event.which == 80) {
						scope.timeframe = 'pm';
						scope.time_input = scope.time + ' ' + scope.timeframe;
					} else if (event.which == 8) {
						scope.edittime.digits.pop();
						scope.time_input = formatTime();
						console.log(scope.edittime.digits);
					}
					scope.edittime.formatted = scope.time_input;
					// scope.edittime.input = formatted;
				};
				
                var pad2 = function (number) {
                    return (number < 10 ? '0' : '') + number;
                };
           
                scope.moving = false;
                scope.offsetx = 0;
                scope.totaloffset = 0;
                scope.initializeTimepicker = function () {
                    currenttime = $('.current-time');
                    timeline = $('.timeline');
                    if (timeline.length > 0) {
                        timeline_width = timeline[0].offsetWidth;
                    }
                    timeline_container = $('.timeline-container');
                    sectionlength = timeline_width / 24 / 6;
                };

                angular.element($window).on('resize', function () {
                    scope.initializeTimepicker();
                    if (timeline.length > 0) {
                        timeline_width = timeline[0].offsetWidth;
                    }
                    sectionlength = timeline_width / 24;
					scope.checkWidth(true);
                });
           
                scope.setTimeBar = function (date) {
					currenttime = $('.current-time');
					var timeline_width = $('.timeline')[0].offsetWidth;
                    var hours = scope.time.split(':')[0];
					if (hours == 12) {
						hours = 0;
					}
					var minutes = scope.time.split(':')[1];
					var minutes_offset = (minutes / 60) * (timeline_width / 12);
					var hours_offset = (hours / 12) * timeline_width;
					scope.currentoffset = parseInt(hours_offset + minutes_offset - 1);
                    currenttime.css({
						transition: 'transform 0.4s ease',
                        transform: 'translateX(' + scope.currentoffset + 'px)',
                    });
                };

                scope.getTime = function () {
                    // get hours
                    var percenttime = (scope.currentoffset + 1) / timeline_width;
                    var hour = Math.floor(percenttime * 12);
                    var percentminutes = (percenttime * 12) - hour;
					var minutes = Math.round((percentminutes * 60) / 5) * 5;
                    if (hour === 0) {
                        hour = 12;
                    }
					if (minutes == 60) {
						hour += 1;
						minutes = 0;
					}

                    scope.time = hour + ":" + pad2(minutes);
					scope.updateInputTime();
                    scope.updateDate();
                };
           
                var initialized = false;

                element.on('touchstart', function() {
                    if (!initialized) {
                        element.find('.timeline-container').on('touchstart', function (event) {
                            scope.timeSelectStart(event);
                        });
                        initialized = true;
                    }
                });

                scope.timeSelectStart = function (event) {
                    scope.initializeTimepicker();
                    var timepicker_container = element.find('.timepicker-container-inner');
					var timepicker_offset = timepicker_container.offset().left;
                    if (event.type == 'mousedown') {
                        scope.xinitial = event.clientX;
                    } else if (event.type == 'touchstart') {
                        scope.xinitial = event.originalEvent.touches[0].clientX;
                    }
                    scope.moving = true;
                    scope.currentoffset = scope.xinitial - timepicker_container.offset().left;
                    scope.totaloffset = scope.xinitial - timepicker_container.offset().left;
					console.log(timepicker_container.width());
					if (scope.currentoffset < 0) {
						scope.currentoffset = 0;
					} else if (scope.currentoffset > timepicker_container.width()) {
						scope.currentoffset = timepicker_container.width();
					}
					currenttime.css({
                        transform: 'translateX(' + scope.currentoffset + 'px)',
                        transition: 'none',
                        cursor: 'ew-resize',
                    });
                    scope.getTime();
                };
           
                angular.element($window).on('mousemove touchmove', function (event) {
                    if (scope.moving === true) {
                        event.preventDefault();
                        if (event.type == 'mousemove') {
                            scope.offsetx = event.clientX - scope.xinitial;
                        } else if (event.type == 'touchmove') {
                            scope.offsetx = event.originalEvent.touches[0].clientX - scope.xinitial;
                        }
                        var movex = scope.offsetx + scope.totaloffset;
                        if (movex >= 0 && movex <= timeline_width) {
                            currenttime.css({
                                transform: 'translateX(' + movex + 'px)',
                            });
                            scope.currentoffset = movex;
                        } else if (movex < 0) {
                            currenttime.css({
                                transform: 'translateX(0)',
                            });
                            scope.currentoffset = 0;
                        } else {
                            currenttime.css({
                                transform: 'translateX(' + timeline_width + 'px)',
                            });
                            scope.currentoffset = timeline_width;
                        }
                        scope.getTime();
                        scope.$apply();
                    }
                });
           
                angular.element($window).on('mouseup touchend', function (event) {
                    if (scope.moving) {
                        // var roundsection = Math.round(scope.currentoffset / sectionlength);
                        // var newoffset = roundsection * sectionlength;
                        // currenttime.css({
                        //     transition: 'transform 0.25s ease',
                        //     transform: 'translateX(' + (newoffset - 1) + 'px)',
                        //     cursor: 'pointer',
                        // });
                        // scope.currentoffset = newoffset;
                        // scope.totaloffset = scope.currentoffset;
                        // $timeout(function () {
                        //     scope.getTime();
                        // }, 250);
                    }
                    scope.moving = false;
                });

                scope.adjustTime = function (direction) {
                    event.preventDefault();
                    scope.initializeTimepicker();
                    var newoffset;
                    if (direction == 'decrease') {
                        newoffset = scope.currentoffset - sectionlength;
                    } else if (direction == 'increase') {
                        newoffset = scope.currentoffset + sectionlength;
                    }
                    if (newoffset < 0 || newoffset > timeline_width) {
                        if (newoffset < 0) {
                            newoffset = timeline_width - sectionlength;
                        } else if (newoffset > timeline_width) {
                            newoffset = 0 + sectionlength;
                        }
                        if (scope.timeframe == 'am') {
                            scope.timeframe = 'pm';
                        }
                        else if (scope.timeframe == 'pm') {
                            scope.timeframe = 'am';
                        }
                    }
                    currenttime.css({
                        transition: 'transform 0.4s ease',
                        transform: 'translateX(' + (newoffset - 1) + 'px)',
                    });
                    scope.currentoffset = newoffset;
                    scope.totaloffset = scope.currentoffset;
                    scope.getTime();
                };
            }
 
            // End Timepicker Code //

        }
    };
});


function clicou_selecionar(){
var info = document.getElementById('data');
var nome = document.getElementById('colaborador');
info = info.innerHTML;
const myArr = info.split(" ");
var dia_semana = myArr[2]; 
dia_semana = dia_semana.split(',');
dia_semana = dia_semana[0];//ok
var dia = myArr[3];//ok
var mes = myArr[5];//ok
var ano = myArr[7];//ok

if(dia.length == 1)
{
 dia = "0"+dia;
}

if(mes =="Janeiro"){mes="01";}
else if (mes=="Fevereiro"){mes="02";}
else if (mes=="Março"){mes="03";}
else if (mes=="Abril"){mes="04";}
else if (mes=="Maio"){mes="05";}
else if (mes=="Junho"){mes="06";}
else if (mes=="Julho"){mes="07";}
else if (mes=="Agosto"){mes="08";}
else if (mes=="Setembro"){mes="09";}
else if (mes=="Outubro"){mes="10";}
else if (mes=="Novembro"){mes="11";}
else {mes="12";}


document.getElementById('titulo').innerHTML = "VA Cheio/Vazio MB - Detecções realizadas em " + dia+"/"+mes+"/"+ano;


document.getElementById('menu').style.display='display';
document.getElementById('tabela').style.display = 'display';
//alert(dia_semana+","+dia+"/"+mes+"/"+ano);
document.getElementById('div_calendario').style.display = 'none'; // oculta o calendario
document.getElementById('data2').value = dia+"/"+mes+"/"+ano;
document.getElementById('btn_calendario').style.display = 'block';

var link_complemento = window.document.getElementById('lb_complemento');
link_complemento = link_complemento.innerHTML;
var link_check = window.document.getElementById('lb_check');
link_check = link_check.innerHTML;

location.href=`tela_va_cheio_vazio_mb.php?complemento=${criptografia2.value}&check=${criptografia.value}&data=${data2.value}&complemento=`+link_complemento+`&check=`+ link_check;


}
function clicou_cancelar(){
    document.getElementById('div_calendario').style.display = 'none';
    document.getElementById('btn_calendario').style.display = 'block';

}
function clicou_exibir_calendario()
{

    document.getElementById('div_calendario').style.display = 'block';
    document.getElementById('btn_calendario').style.display = 'none';
}

</script>





<script>
    document.getElementById('info_zerar').style.visibility='hidden'; // inicia ocultando div zerar
    document.getElementById('div_justificar').style.visibility='hidden'; // inicia ocultando div justificar
    document.getElementById('div_calendario').style.display = 'none'; // inicia calendario oculto
    document.getElementById('v_relatorio').style.display = 'none'; // Inicia relatorio oculto
    document.getElementById('div_justificativa').style.visibility = 'hidden';// Inicia a tela justificativa oculta

</script>








</body>
</html>
<style>
INPUT#data2{
    position: absolute;
    left: 80%;
    top: 5%;
    font: normal 12pt verdana;
    color:	#000000;
    width:110px;
    height: 25px;
}
INPUT#ref1{
    position: absolute;
    left: 80%;
    top: 8%;
    font: normal 12pt verdana;
    color:	#000000;
    width:110px;
    height: 25px;
}
IMG#btn_calendario{
    position: absolute;
    left: 38%;
    top: -6%;
    padding: 5px;
    margin-left: 0px;
    width: 53px;
    height: 53px;
    background-color: #808080;
    border-radius: 8px!important;
    border: 1px #000000 solid!important;
    
    cursor: pointer;
}
IMG#btn_calendario:hover
{
 background-color: #D3D3D3; /* Preto */
 color: white;
}
IMG#btn_calendario:active {
  background-color: #696969;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}




LABEL#valor_registro{
    position: absolute;
    left: 4%;
    top: 10%;
    font: normal 12pt verdana;
    color:	#000000;
}
INPUT#v_registro{
    position: absolute;
    color: #000000;
    margin-left: 0px;
    font: normal 12pt verdana;
    left:17%;
    top: 3%;
    background-color: transparent;
    width:100px;
    height:35px;
    border: transparent;
    cursor: pointer;

}
LABEL#valor_nome{
    position: absolute;
    left: 32%;
    top: 10%;
    font: normal 12pt verdana;
    color:	#000000;
}
INPUT#v_nome{
    position: absolute;
    color: #000000;
    margin-left: 0px;
    font: normal 12pt verdana;
    left:42%;
    top: 3%;
    background-color: transparent;
    width:300px;
    height:35px;
    border: transparent;
    cursor: pointer;

}
LABEL#lb_valor_parecer{
    position: absolute;
    left: 4%;
    top: 30%;
    font: normal 12pt verdana;
    color:	#000000;
}

TEXTAREA#v_parecer{
    position: absolute;
    color: #000000;
    font: normal 12pt verdana;
    left:17%;
    top: 30%;
    
    background-color: transparent;
   
    border: transparent;
    cursor: pointer;

}


DIV#info_zerar{
  position: absolute;
    left: 37%;
    top: 28%;
    background-color: #363636;
    width:22%;
    height: 22%;
    text-align:left;

    border-radius: 8px!important;
    border: 4px #000000 solid!important;
}
LABEL#lb_info_zerar2{
  margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 8%;
    font: bold 14pt verdana;
    color:	red;
}
LABEL#lb_info_zerar{
  margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 25%;
    font: normal 14pt verdana;
    color:	#ffffff;
}


INPUT#sim
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:10.5%;
    top: 70%;
    width:100px;
    height:35px;
    padding-left: 5px;
    background-color:  rgba(0,170,0,0.9);
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#sim:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#sim:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

INPUT#nao
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:55%;
    top: 70%;
    width:100px;
    height:35px;
    padding-left: 5px;
    background-color: #DC143C;
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#nao:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#nao:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}












DIV#div_justificar{
    position: absolute;
    left: 37%;
    top: 28%;
    background-color: #363636;
    width:22%;
    height: 22%;
    text-align:left;

    border-radius: 8px!important;
    border: 4px #000000 solid!important;
  
}
LABEL#lb_info_justificar2{
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 8%;
    font: bold 14pt verdana;
    color:	red;
}
LABEL#lb_info_justificar{
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 25%;
    font: normal 14pt verdana;
    color:	#ffffff;
}


INPUT#sim2
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:10.5%;
    top: 70%;
    width:100px;
    height:35px;
    padding-left: 5px;
    background-color: rgba(0,170,0,0.9);
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#sim2:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#sim2:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

INPUT#nao2
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:55%;
    top: 70%;
    width:100px;
    height:35px;
    padding-left: 5px;
    background-color: #DC143C;
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#nao2:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#nao2:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}










DIV#div_justificativa{
    position: absolute;
    left: 32%;
    top: 23%;
    background-color: rgba(10,20,20,1);
    width:31%;
    height: 31%;
    text-align:left;
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
}



LABEL#lb_justificativa{
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 4%;
    font: bold 14pt verdana;
    color:	red;
}
LABEL#lb_parecer_justificativa{
    margin-left: 0px;
    position: absolute;
    left: 5%;
    top: 14%;
    font: normal 14pt verdana;
    color:	#ffffff;
}

TEXTAREA#valor_parecer{
    position: absolute;
    color: #000000;
    font: normal 12pt verdana;
    left:4%;
    top: 28%;    
    background-color: rgba(200,200,200,0.8);
    border: transparent;
    cursor: pointer;
    text-align:left;
    border-radius: 4px!important;
    border: 1px #000000 solid!important;

}


INPUT#salvar_justificativa
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:10.5%;
    top: 80%;
    width:120px;
    height:40px;
    padding-left: 5px;
    background-color: rgba(0,170,0,0.9);
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#salvar_justificativa:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#salvar_justificativa:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

INPUT#sair_justificativa
{
    color: #FFFFFF;
    margin-left: 0px;
    position: absolute;
    font: normal 13pt verdana;
    left:62%;
    top: 80%;
    width:120px;
    height:40px;
    padding-left: 5px;
    background-color: #DC143C;
    border-radius: 8px!important;
    border: 4px #000000 solid!important;
    cursor: pointer;

}
INPUT#sair_justificativa:hover
{
 background-color: #555555; /* Preto */
 color: white;
}
INPUT#sair_justificativa:active {
  background-color: #00008B;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}








INPUT#btn_relatorio {
    background-image: url( './images/assignment.png' );
    background-size: 60px 60px;
    height: 63px;  
    width: 63px;
    padding: 2px;
    position:absolute;
    top: 2%;
    left: 8%;
    background-color: #808080;
    border-radius: 8px!important;
    border: 1px #000000 solid!important;
}
INPUT#btn_relatorio:hover
{
 background-color: #D3D3D3; /* Preto */
 color: white;
}
INPUT#btn_relatorio:active {
  background-color: #696969;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}





INPUT#btn_dashboard {
    background-image: url( './images/assessment.png' );
    background-size: 60px 60px;
    height: 63px;  
    width: 63px;
    position:absolute;
    top: 10.5%;
    left: 8%;
    background-color: #808080;
    border-radius: 8px!important;
    border: 1px #000000 solid!important;
}
INPUT#btn_dashboard:hover
{
 background-color: #D3D3D3; /* Preto */
 color: white;
}
INPUT#btn_dashboard:active {
  background-color: #696969;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}




INPUT#btn_configuracoes {
    background-image: url( './images/build.png' );
    background-size: 60px 60px;
    height: 63px;  
    width: 63px;
    position:absolute;
    top: 19%;
    left: 8%;
    background-color: #808080;
    border-radius: 8px!important;
    border: 1px #000000 solid!important;
}
INPUT#btn_configuracoes:hover
{
 background-color: #D3D3D3; /* Preto */
 color: white;
}
INPUT#btn_configuracoes:active {
  background-color: #696969;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}




INPUT#btn_descartados {
    background-image: url( './images/videocam_off.png' );
    background-size: 60px 60px;
    height: 63px;  
    width: 63px;
    position:absolute;
    top: 27.5%;
    left: 8%;
    background-color: #808080;
    border-radius: 8px!important;
    border: 1px #000000 solid!important;
}
INPUT#btn_descartados:hover
{
 background-color: #D3D3D3; /* Preto */
 color: white;
}
INPUT#btn_descartados:active {
  background-color: #696969;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}



INPUT#btn_sirene {
    background-image: url( './images/volume_up.png' );
    background-size: 60px 60px;
    height: 63px;  
    width: 63px;
    position:absolute;
    top: 36%;
    left: 8%;
    background-color: #808080;
    border-radius: 8px!important;
    border: 1px #000000 solid!important;
}
INPUT#btn_sirene:hover
{
 background-color: #D3D3D3; /* Preto */
 color: white;
}
INPUT#btn_sirene:active {
  background-color: #696969;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}


DIV#menu{
    margin-left: 0px;
    position: absolute;
    top: 4%;
    left: 0%;
    width:  80px;
    height: 96%;
    background-color: #1C1C1C; //cor do menu dos botoes
    border-radius: 1px!important;
    border-color: #1C1C1C;
    border-style: solid!important;
}


DIV#player1{
    margin-left: 0px;
    position: absolute;
    top: 165px;
    left: 580px;
    width:  645px;
    height: 485px;
    border-radius: 1px!important;
    border-color: #000000;
    border-style: solid!important;
}

DIV#dados{
    padding-top: 15px;
    padding-left: 10px;
    position: absolute;
    top: 4.4%;
    left: 44.6%;
    width:  646px;
    height: 125px;
    background-color: #DCDCDC; //Cor do fundo da justificativa
    border-radius: 1px!important;
    border-color: #000000;
    border-style: solid!important;
}


.th1{
    width: 580px;
    height: -100px;
    background-color: 	#F5FFFA; // fundo da tabela onde tem as fotos
     
}

table {
    width: 550px;
    height: 600px;
    position: absolute;
    left: 0px;
    top: 30px;
    display:inline-block;
    background-color: blue;
    font: normal 12pt times;
}


tbody {
    height: 618px;
    display: inline-block;
    width: 100%;
    background-color:#F8F8FF;
    overflow: auto;

}


IMG#foto{
    margin-left: 0px;
    position: absolute;
    left: -170px;
    top: 5px;
    padding: 0px;
    width:  160px;
    height: 140px;
    border-radius: 6px!important;
    border-color: #1C1C1C;
    border-style: solid!important;
}
DIV#foto{
    margin-left: 0px;
    position: relative;
    left: 180px;
    top: 0px;
    padding-top: 15px;
    width:  350px;
    height: 144px;
    background-color: transparent;
    margin-bottom: 10px;
}


DIV#tabela{
    margin-top: 0px;
    padding: 0px;
    position: absolute;
    top: 90px;
    left: 120px;
    height: 680px;
    width: 1300px;
    //background-color: red; 
   
}
DIV#v_relatorio{
    margin-top: 0px;
    padding: 0px;
    position: absolute;
    top: 7%;
    left: 7.5%;
    height: 690px;
    width: 1300px;
    background-color: red; 
   
}



a#assistir {
    font-weight: normal;
    font-family: verdana;font-size: 9pt;
    color: #FFFFFF;
    background-color: #1C1C1C;
    border-radius: 5px!important;
    padding-left: 8px;
    padding-right: 8px;
    padding-top: 6px;
    padding-bottom: 7px;
    border-style: 5px,solid!important;
    cursor: pointer;
    text-align: center;

}
a#justificar {
    font-weight: normal;
    font-family: verdana;font-size: 9pt;
    color: #FFFFFF;
    border-radius: 5px!important;
    padding-left: 8px;
    padding-right: 8px;
    padding-top: 5px;
    padding-bottom: 5px;
    border-style: 5px,solid!important;
    
    cursor: pointer;
    text-align: center;

}

a#ignorar {
    font-weight: normal;
    font-family: verdana;font-size: 9pt;
    color: #FFFFFF;
    background-color: #DAA520;
    border-radius: 5px!important;
    padding-left: 8px;
    padding-right: 8px;
    padding-top: 5px;
    padding-bottom: 5px;
    border-style: 5px,solid!important;
    cursor: pointer;
    text-align: center;

}



LABEL#titulo{
    margin-left: 0%;
    position: absolute;
    font: normal 12pt verdana;
    color:#ffffff;
    left: 0%;
    top: -6%;
}
LABEL#titulo2{
    margin-left: 0%;
    position: absolute;
    font: normal 12pt verdana;
    color:#ffffff;
    left: 0%;
    top: -1.9%;
}

LABEL#info_eventos{
    margin-left: 0%;
    position: absolute;
    font: normal 12pt verdana;
    color:#ffffff;
    left: 46%;
    top: -6%;
}

LABEL#info_eventos2{
    margin-left: 0%;
    position: absolute;
    font: normal 12pt verdana;
    color:#ffffff;
    left: 46%;
    top: -2%;
}

LABEL#info_eventos3{
    margin-left: 0%;
    position: absolute;
    font: normal 12pt verdana;
    color:#ffffff;
    left: 64%;
    top: -6%;
}





IMG#voltar{
    margin-left: 0px;
    position: absolute;
    left: 8px;
    top: 2%;
    width: 32px;
    height: 32px;
    cursor: pointer;

}
IMG#home{
    margin-left: 0px;
    position: absolute;
    left: 38px;
    top:  2%;
    width: 28px;
    height: 28px;
    cursor: pointer;

}


#lb_desenvolvedor{
    margin-left: 0px;
    position: absolute;
    left: 38%;
    top: 95%;
    font: normal 11pt verdana;
    color:#ffffff;
}


#conexao{
    margin-left: 0%;
    position: absolute;
    padding-left:1%;
    padding-top:1%;
    text-align:left;
    font: normal 18pt verdana;
    color:#ffffff;
    left: 0%;
    top: 0%;
    width:100%;
    height:4.2%;
    background-color:#1C1C1C;
    border-radius: 0px!important;
    border: 2px #222 solid!important;
}
#colaborador{
    margin-left: 0%;
    position: absolute;
    padding-left:1%;
    padding-top:1%;
    text-align:left;
    font: normal 11pt verdana;
    color:#ffffff;
    left: 3%;
    top: -36%;
}
#funcao{
    margin-left: 0px;
    position: absolute;
    padding-left:10px;
    padding-top:5px;
    text-align:left;
    font: normal 11pt verdana;
    color:#ffffff;
    left: 80%;
    top: 5%;
}

INPUT#criptografia
{
    margin-left: 0px;
    position: absolute;
    padding-left:10px;
    padding-top:5px;
    text-align:left;
    width: 300px;
    font: normal 11pt verdana;
    color:#000000;
    left: 30%;
    top: 5%;

}
INPUT#criptografia2
{
    margin-left: 0px;
    position: absolute;
    padding-left:10px;
    padding-top:5px;
    text-align:left;
    width: 100px;
    font: normal 11pt verdana;
    color:#000000;
    left: 55%;
    top: 5%;

}




[ng\:cloak], [ng-cloak], .ng-cloak {
  display: none;
}

* {
  box-sizing: border-box;
}

html, body {
  margin: 0;
  background: #363636; // Cor do fundo da tela
}

.app-container { // Calendario
  border-radius: 4px;
  overflow: hidden;
  width: 720px;
  height: auto;
  max-width: 100%;
  position: absolute;
  top: 50px;
  left: 0;
  right: 0;
  margin: auto;
  border-radius: 8px!important;
    border: 10px #000000 solid!important;
}

.buttons-container {
  position: absolute;
  bottom: 15px;
  right: 0;
  height: 40px;
  font-family: "Roboto", sans-serif;
}

.cancel-button,
.save-button {
  float: left;
  height: 40px;
  line-height: 40px;
  padding: 0 15px;
  border-radius: 2px;
  margin-right: 15px;
  cursor: pointer;
  -webkit-transition: all 0.15s ease;
  transition: all 0.15s ease;
}

.cancel-button {
  background: white;
  color: #1C1C1C;
}

.save-button {
  background: #1C1C1C;
  color: white;
}

/* Datepicker Stuff */
.datepicker {
  position: relative;
  width: 100%;
  display: block;
  -webkit-tap-highlight-color: transparent;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  -o-user-select: none;
  user-select: none;
  font-family: "Roboto", sans-serif;
  overflow: hidden;
  -webkit-transition: background 0.15s ease;
  transition: background 0.15s ease;
}

.datepicker.am {
  background: white;
}

.datepicker.pm {
  background: #1C1C1C;
}

.datepicker-header {
  width: 100%;
  color: white;
  overflow: hidden;
}

.datepicker-title {
  width: 50%;
  float: left;
  height: 60px;
  line-height: 60px;
  padding: 0 15px;
  text-align: left;
  font-size: 20px;
}

.datepicker-subheader {
  width: 50%;
  float: left;
  height: 60px;
  line-height: 60px;
  font-size: 14px;
  padding: 0 15px;
  text-align: right;
}

.datepicker-calendar {
  width: 50%;
  float: left;
  padding: 20px 15px 15px;
  max-width: 400px;
  display: block;
}

.calendar-header {
  color: black;
  font-weight: bolder;
  text-align: center;
  font-size: 18px;
  padding: 10px 0;
  position: relative;
}

.current-month-container {
  display: inline-block;
  height: 30px;
  position: relative;
}

.goback,
.goforward {
  height: 30px;
  width: 30px;
  border-radius: 30px;
  display: inline-block;
  cursor: pointer;
  position: relative;
  top: -4px;
}

.goback path,
.goforward path {
  -webkit-transition: stroke 0.15s ease;
  transition: stroke 0.15s ease;
}

.goback {
  float: left;
  margin-left: 3.8%;
}

.goforward {
  float: right;
  margin-right: 3.8%;
}

.calendar-day-header {
  width: 100%;
  position: relative;
}

.day-label {
  color: #8A8A8A;
  padding: 5px 0;
  width: 14.2857142%;
  display: inline-block;
  text-align: center;
}

.datecontainer {
  width: 14.2857142%;
  display: inline-block;
  text-align: center;
  padding: 4px 0;
}

.datenumber {
  max-width: 35px;
  max-height: 35px;
  line-height: 35px;
  margin: 0 auto;
  color: #8A8A8A;
  position: relative;
  text-align: center;
  cursor: pointer;
  z-index: 1;
  -webkit-transition: all 0.25s cubic-bezier(0.7, -0.12, 0.2, 1.12);
  transition: all 0.25s cubic-bezier(0.7, -0.12, 0.2, 1.12);
}

.no-hover .datenumber,
.no-hover .datenumber:hover,
.no-hover .datenumber:before,
.no-hover .datenumber:hover::before {
  cursor: default;
  color: #8A8A8A;
  background: transparent;
  opacity: 0.5;
}

.no-hover .datenumber.day-selected {
  color: white;
}

.datenumber:hover {
  color: white;
}

.datenumber:before {
  content: '';
  display: block;
  position: absolute;
  height: 35px;
  width: 35px;
  border-radius: 100px;
  z-index: -1;
  background: transparent;
  -webkit-transform: scale(0.75);
  transform: scale(0.75);
  -webkit-transition: all 0.25s cubic-bezier(0.7, -0.12, 0.2, 1.12);
  transition: all 0.25s cubic-bezier(0.7, -0.12, 0.2, 1.12);
  -webkit-transition-property: background, color, border, -webkit-transform;
  transition-property: background, color, border, -webkit-transform;
  transition-property: background, transform, color, border;
  transition-property: background, transform, color, border, -webkit-transform;
}

.datenumber:hover::before {
  background: #FFAB91;
  -webkit-transform: scale(1);
  transform: scale(1);
}

.day-selected {
  color: white;
}

.datenumber.day-selected:before {
  background: #FF6E40;
  -webkit-transform: scale(1);
  transform: scale(1);
  -webkit-animation: select-date .25s forwards;
  animation: select-date .25s forwards;
}

@-webkit-keyframes select-date {
  0% {
    background: #FFAB91;
  }
  100% {
    background: #FF6E40;
  }
}
@keyframes select-date {
  0% {
    background: #FFAB91;
  }
  100% {
    background: #FF6E40;
  }
}
/* timepicker styles */
.timepicker-container-outer {
  width: 50%;
  max-width: 700px;
  float: left;
  display: block;
  padding: 40px 30px 30px;
  position: relative;
  top: 50px;
  overflow: hidden;
  -webkit-tap-highlight-color: transparent;
  -webkit-transition: background 0.15s ease;
  transition: background 0.15s ease;
}

.timepicker-container-inner {
  width: 100%;
  height: 100%;
  max-width: 320px;
  margin: 0 auto;
  position: relative;
  display: block;
}

.timeline-container {
  display: block;
  float: left;
  position: relative;
  width: 100%;
  height: 36px;
}

.current-time {
  display: block;
  position: absolute;
  z-index: 1;
  width: 40px;
  height: 40px;
  border-radius: 20px;
  top: -25px;
  left: -20px;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.current-time::after {
  content: '';
  display: block;
  width: 40px;
  height: 40px;
  position: absolute;
  background: #FF6E40;
  -webkit-transition: all 0.15s ease;
  transition: all 0.15s ease;
  -webkit-transform: rotate(45deg);
  transform: rotate(45deg);
  border-radius: 20px 20px 3px 20px;
  z-index: -1;
  top: 0;
}

.actual-time {
  color: white;
  line-height: 40px;
  font-size: 12px;
  text-align: center;
  -webkit-transition: all 0.15s ease;
  transition: all 0.15s ease;
}

.timeline {
  display: block;
  z-index: 1;
  width: 100%;
  height: 2px;
  position: absolute;
  bottom: 0;
}

.timeline::before, .timeline::after {
  content: '';
  display: block;
  width: 2px;
  height: 10px;
  top: -6px;
  position: absolute;
  background: #1C1C1C;
  left: -1px;
  -webkit-transition: background 0.15s ease;
  transition: background 0.15s ease;
}

.timeline::after {
  left: auto;
  right: -1px;
}

.hours-container {
  display: block;
  z-index: 0;
  width: 100%;
  height: 10px;
  position: absolute;
  top: 31px;
  left: 1px;
}

.hour-mark {
  width: 2px;
  display: block;
  float: left;
  height: 4px;
  background: #1C1C1C;
  position: relative;
  margin-left: calc((100% / 12) - 2px);
  -webkit-transition: background 0.15s ease;
  transition: background 0.15s ease;
}

.hour-mark:nth-child(3n) {
  height: 6px;
  top: -1px;
}

.display-time {
  width: calc(60% - 30px);
  display: block;
  margin-top: 30px;
  height: 36px;
  line-height: 36px;
  overflow: hidden;
  float: left;
  position: relative;
  font-size: 20px;
  text-align: center;
  -webkit-transition: color 0.15s ease;
  transition: color 0.15s ease;
}

.decrement-time,
.increment-time {
  cursor: pointer;
  position: absolute;
  display: block;
  width: 24px;
  height: 24px;
  line-height: 24px;
  top: 6px;
  font-size: 20px;
}

.decrement-time {
  left: 0;
  text-align: left;
}

.increment-time {
  right: 0;
  text-align: right;
}

.increment-time path,
.decrement-time path {
  -webkit-transition: all 0.15s ease;
  transition: all 0.15s ease;
}

.time {
  width: calc(100% - 48px);
  position: relative;
  left: 24px;
  height: 36px;
}
.time:after {
  content: '';
  height: 2px;
  width: 100%;
  position: absolute;
  bottom: 0;
  background: white;
  left: 0;
  right: 0;
  opacity: 0.5;
  -webkit-transition: all 0.15s ease;
  transition: all 0.15s ease;
}

.time.time-active:after {
  display: none;
}

.time-input {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 34px;
  line-height: 34px;
  bottom: 2px;
  width: 100%;
  border: none;
  background: none;
  text-align: center;
  color: white;
  font-size: inherit;
  opacity: 0;
  -webkit-transition: all 0.15s ease;
  transition: all 0.15s ease;
  cursor: pointer;
}
.time-input:focus, .time-input:active {
  outline: none;
}

.formatted-time {
  cursor: pointer;
}

.time-input:focus {
  cursor: auto;
}
.time-input:focus ~ .formatted-time {
  border-radius: 2px;
  background: #1C1C1C;
  color: white;
  cursor: default;
}

.am-pm-container {
  width: 40%;
  padding-left: 15px;
  float: right;
  height: 36px;
  line-height: 36px;
  display: block;
  position: relative;
  margin-top: 30px;
}

.am-pm-button {
  width: calc(50% - 5px);
  height: 36px;
  line-height: 36px;
  background: #2196F3;
  text-align: center;
  color: white;
  border-radius: 4px;
  float: left;
  cursor: pointer;
}

.am-pm-button:first-child {
  background: #1C1C1C;
  color: white;
}

.am-pm-button:last-child {
  background: white;
  color: #1C1C1C;
  margin-left: 10px;
}

@-webkit-keyframes select-date-pm {
  0% {
    background: rgba(255, 255, 255, 0.5);
  }
  100% {
    background: #FFF;
  }
}
@keyframes select-date-pm {
  0% {
    background: rgba(255, 255, 255, 0.5);
  }
  100% {
    background: #FFF;
  }
}
.datepicker.am .datepicker-header {
  color: white;
  background: #1C1C1C;
}
.datepicker.am .current-time::after {
  background: #1C1C1C;
}
.datepicker.am .actual-time {
  color: white;
}
.datepicker.am .display-time {
  color: #FF6E40;
}
.datepicker.am .time-input {
  color: #FF693C;
}
.datepicker.am .time:after {
  background: #FF693C;
}
.datepicker.am .increment-time path,
.datepicker.am .decrement-time path {
  stroke: #FF693C;
}

.datepicker.pm .datepicker-header {
  background: white;
  color: #FF693C;
}
.datepicker.pm .datepicker-subheader {
  color: #1C1C1C;
}
.datepicker.pm .goback:before,
.datepicker.pm .goback:after,
.datepicker.pm .goforward:before,
.datepicker.pm .goforward:after {
  background: white;
}
.datepicker.pm .day-label {
  color: white;
}
.datepicker.pm .datenumber {
  color: white;
}
.datepicker.pm .datenumber:hover::before {
  background: rgba(255, 255, 255, 0.5);
  -webkit-transform: scale(1);
  transform: scale(1);
}
.datepicker.pm .datenumber.day-selected {
  color: #FF693C;
}
.datepicker.pm .datenumber.day-selected:before {
  background: white;
  -webkit-animation: select-date-pm .25s forwards;
  animation: select-date-pm .25s forwards;
}
.datepicker.pm .current-month-container {
  color: white;
}
.datepicker.pm .current-time::after {
  background: white;
}
.datepicker.pm .actual-time {
  color: #FF6E40;
}
.datepicker.pm .display-time {
  color: white;
}
.datepicker.pm .timeline::before, .datepicker.pm .pm .timeline::after {
  background: white;
}
.datepicker.pm .hour-mark {
  background: white;
}
.datepicker.pm .am-pm-button:last-child {
  color: #FF6E40;
}
.datepicker.pm .cancel-button {
  background: none;
  color: white;
}
.datepicker.pm .save-button {
  background: white;
  color: #FF693C;
}
.datepicker.pm .goback path,
.datepicker.pm .goforward path {
  stroke: white;
}
.datepicker.pm .time-input:focus ~ .formatted-time {
  background: white;
  color: #FF693C;
}

.datepicker.compact .datepicker-title,
.datepicker.compact .datepicker-subheader {
  width: 100%;
  text-align: center;
}
.datepicker.compact .datepicker-title {
  height: 50px;
  line-height: 50px;
}
.datepicker.compact .datepicker-subheader {
  height: 30px;
  line-height: 30px;
}
.datepicker.compact .display-time {
  width: 60%;
  font-size: 20px;
  line-height: 36px;
}
.datepicker.compact .app-container {
  width: 100%;
}
.datepicker.compact .datepicker-calendar {
  width: 100%;
  margin: 0 auto;
  float: none;
}
.datepicker.compact .timepicker-container-outer {
  width: 100%;
  margin: 0 auto;
  float: none;
  top: -15px;
}
.datepicker.compact .buttons-container {
  position: relative;
  float: right;
}


</style>