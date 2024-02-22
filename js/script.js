/* eslint-disable no-undef */
/* eslint linebreak-style: ["error", "windows"] */

$(function () {
	var calendar = $("#calendar").fullCalendar({
		monthNames: [
			"Januar",
			"Februar",
			"März",
			"April",
			"Mai",
			"Juni",
			"Juli",
			"August",
			"September",
			"Oktober",
			"November",
			"Dezember",
		],
		monthNamesShort: [
			"Jan",
			"Feb",
			"Mär",
			"Apr",
			"Mai",
			"Jun",
			"Jul",
			"Aug",
			"Sep",
			"Okt",
			"Nov",
			"Dez",
		],
		dayNames: [
			"Sonntag",
			"Montag",
			"Dienstag",
			"Mittwoch",
			"Donnerstag",
			"Freitag",
			"Samstag",
			"Sonntag",
		],
		dayNamesShort: ["So", "Mo", "Di", "Mi", "Do", "Fr", "Sa"],
		buttonText: {
			today: "Heute",
			month: "Monat",
			week: "Woche",
			day: "Tag",
		},
		allDayText: "ganztägig",
		slotLabelFormat: "HH:mm",
		views: {
			week: {
				titleFormat: "D. MMM Y",
				columnFormat: "ddd, D.M",
			},
			day: {
				titleFormat: "D. MMMM Y",
			},
		},
		editable: true,
		header: {
			left: "prevYear,prev,next,nextYear, today",
			center: "title",
			right: "month,agendaWeek,agendaDay",
		},
		events: "load.php",
		selectable: true,
		selectHelper: true,
		timeFormat: "HH:mm",
		/*select: function(start, end, allDay)
        {
         var title = prompt("Ereignisname eingeben:");
         if(title)
         {
          var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
          var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
          $.ajax({
           url:"insert.php",
           type:"POST",
           data:{title:title, start:start, end:end},
           success:function()
           {
            calendar.fullCalendar("refetchEvents");
            alert("Erfolgreich");
           }
          })
         }
        },*/
		select: function (start, end) {
			$("#event-details-modal")
				.find("[id=start]")
				.val(start.format("DD.MM.YYYY HH:mm"));
			$("#event-details-modal")
				.find("[id=end]")
				.val(end.format("DD.MM.YYYY HH:mm"));

			$("#event-details-modal").modal("toggle");
		},

		eventResize: function (event) {
			var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
			var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
			var title = event.title;
			var description = event.description;
			var id = event.id;
			$.ajax({
				url: "update.php",
				type: "POST",
				data: {
					title: title,
					description: description,
					start: start,
					end: end,
					id: id,
				},
				success: function () {
					calendar.fullCalendar("refetchEvents");
					alert("Ereignisaktualisierung");
				},
			});
		},

		eventDrop: function (event) {
			var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
			var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
			var title = event.title;
			var description = event.description;
			var id = event.id;
			$.ajax({
				url: "update.php",
				type: "POST",
				data: {
					title: title,
					description: description,
					start: start,
					end: end,
					id: id,
				},
				success: function () {
					calendar.fullCalendar("refetchEvents");
					alert("Ereignis wurde aktualisiert");
				},
			});
		},

		eventClick: function (event) {
			$("#event-details-modal").find("[id=title]").val(event.title);
			$("#event-details-modal").find("[id=description]").val(event.description);
			$("#event-details-modal")
				.find("[id=start]")
				.val(event.start.format("DD.MM.YYYY HH:mm"));
			$("#event-details-modal")
				.find("[id=end]")
				.val(event.end.format("DD.MM.YYYY HH:mm"));

			$("#event-details-modal").modal("toggle");
		},

		/*eventClick:function(event)
        {
         if(confirm("Sind Sie sicher, dass Sie das Ereignis entfernen wollen?"))
         {
          var id = event.id;
          $.ajax({
           url:"delete.php",
           type:"POST",
           data:{id:id},
           success:function()
           {
            calendar.fullCalendar("refetchEvents");
            alert("Ereignis wurde entfernt");
           }
          })
         }
        },*/

		/*eventClick: function (event, jsEvent, view) {
                var title = prompt('Ereignisname:', event.title);
                if (title){
                    event.title = title;
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                     $.ajax({
                            url: "update.php",
                            data: 'title=' + title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                            type: "POST",
                            success:function()
                            {
                                calendar.fullCalendar("refetchEvents");
                                alert("Ereignis wurde aktualisiert");
                            }
                        });
                     calendar.fullCalendar('renderEvent',
                            {
                                title: title,
                                start: start,
                                end: end,
                            },
                    true
                            );

              }
               calendar.fullCalendar('unselect');
            },*/
	});
});