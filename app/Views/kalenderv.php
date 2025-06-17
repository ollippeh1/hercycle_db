<!DOCTYPE html>
<html>

<head>
    <title>Kalender Haid & Ovulasi</title>

    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
</head>

<body>

    <div id='calendar' class="kalender-custom"></div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            selectable: true,
            select: function(info) {
                var selectedDate = info.startStr;

                $.ajax({
                    url: '/kalenderv/save',
                    method: 'POST',
                    data: {
                        tanggal_akhir_haid: selectedDate,
                        lama_haid: 7,
                        siklus_haid: 28,
                        siklus_hamil: 40
                    },
                    success: function(res) {
                        calendar.refetchEvents();
                        alert("Data berhasil disimpan!");
                    }
                });
            },
            events: '/kalenderv/events'
        });

        calendar.render();
    });
    </script>

</body>

</html>