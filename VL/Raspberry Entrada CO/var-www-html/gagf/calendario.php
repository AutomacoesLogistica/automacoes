<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Date and Time Picker</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  
  


  
</head>

<body>
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
							<path fill="none" stroke="#0DAD83" stroke-width="3" d="M19,6 l-9,9 l9,9"/>
						</svg>
					</div>
					<div class="current-month-container">{{ currentViewDate.getFullYear() }} {{ currentMonthName() }}</div>
					<div class="goforward" ng-click="moveForward()" ng-if="pickdate">
						<svg width="30" height="30">
							<path fill="none" stroke="#0DAD83" stroke-width="3" d="M11,6 l9,9 l-9,9" />
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
info = info.innerHTML;
const myArr = info.split(" ");
var dia_semana = myArr[2]; 
dia_semana = dia_semana.split(',');
dia_semana = dia_semana[0];//ok
var dia = myArr[3];//ok
var mes = myArr[5];//ok
var ano = myArr[7];//ok

//alert(dia_semana+","+dia+"/"+mes+"/"+ano);
document.getElementById('div_calendario').style.display = 'none'; // oculta o calendario
document.getElementById('data2').innerHTML = dia_semana+","+dia+"/"+mes+"/"+ano;




}
function clicou_cancelar(){
    document.getElementById('div_calendario').style.display = 'none';
}
function clicou_exibir_calendario()
{
    document.getElementById('div_calendario').style.display = 'block';
}
</script>


<label id="data2">teste</label>
<input type="button" id='btn_calendario' name='btn_calendario' value='Calendario'onclick="clicou_exibir_calendario();"/>
</body>
</html>
<style>

[ng\:cloak], [ng-cloak], .ng-cloak {
  display: none;
}

* {
  box-sizing: border-box;
}

html, body {
  margin: 0;
  background: #222;
}

.app-container {
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
  color: #0DAD83;
}

.save-button {
  background: #0DAD83;
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
  background: #0DAD83;
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
  background: #0DAD83;
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
  background: #0DAD83;
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
  background: #0DAD83;
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
  background: #0DAD83;
  color: white;
}

.am-pm-button:last-child {
  background: white;
  color: #0DAD83;
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
  background: #0DAD83;
}
.datepicker.am .current-time::after {
  background: #0DAD83;
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
  color: #0DAD83;
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