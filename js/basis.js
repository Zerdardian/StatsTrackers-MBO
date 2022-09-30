$(document).ready(function () {
    var page = $('#hpage').val();
    var item = $('#hitem').val()
    var pageitem = $('#hpageitem')
    $('input.general').change(function () {
        if (page == 'user') {
            if (item == 'userinfo') {
                var id = this.id
                var value = this.value
                var dataject = {
                    'page': page,
                    'item': item,
                    'id': id,
                    'value': value
                }
                $.ajax({
                    type: "POST",
                    url: "/ajax/userinfo.php",
                    data: dataject,
                    success: function (response) {
                        var json = JSON.parse(response);

                        if (json.code == 200) {
                            $('.succes').text(json.message);
                            $('.succes').addClass('active')
                            $('.error').removeClass('active')

                            timeout = setTimeout(() => {
                                $('.succes').text('')
                                $('.succes').removeClass('active');
                            }, 5000);
                        }

                        if (json.code == 404) {
                            $('.error').text(json.message);
                            $('.error').addClass('active')
                            $('.succes').removeClass('active')

                            setTimeout(() => {
                                $('.error').text('')
                                $('.error').removeClass('active');
                            }, 5000);
                        }
                    }
                });
            }
        }
    })


    $('#userinfo').ready(function () {
        console.log('userinfo');
        $('input').change(function () {
            var value = $(this).val();
            var team = $(this).data('teamid');

            // Goals
            if ($(this).hasClass('inputgoals')) {
                var id = 'goals';
                var items = {
                    teamid: team,
                    goals: value
                }
                var dataject = {
                    'page': page,
                    'item': 'standings',
                    'id': id,
                    'value': 'null',
                    'array': items
                }

                console.log(dataject);
                $.ajax({
                    type: "POST",
                    url: "/ajax/standings.php",
                    data: dataject,
                    success: function (response) {
                        console.log(response);
                    }
                })
            }

            // Assists
            if ($(this).hasClass('inputassists')) {
                var id = 'assists';
                var items = {
                    teamid: team,
                    assists: value
                }
                var dataject = {
                    'page': page,
                    'item': 'standings',
                    'id': id,
                    'value': 'null',
                    'array': items
                }

                console.log(dataject);
                $.ajax({
                    type: "POST",
                    url: "/ajax/standings.php",
                    data: dataject,
                    success: function (response) {
                        console.log(response);
                    }
                })
            }
        })

        // $('input.inputgoals').change(function() {
        //     var item = $(this);
        //     var teamid = item.data('teamid');
        //     var value = item.val();

        //     console.log(teamid);
        // })

        // $('input.inputassists').change(function() {
        //     var item = $(this);
        //     var teamid = item.data('teamid');
        //     var value = item.val();

        //     console.log(value);
        // })
    })
})