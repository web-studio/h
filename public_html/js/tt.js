$(document).ready(function() {
    var timer = 15;
    var timer2 = 1;
    var timer3 = 15;
    var timerIntervel;
    var timerIntervel2;
    var timerIntervel3;

    $('#timer').html(timer);



    var metrics = [
        ['#form1 #input1', /^[а-яА-Я]+$/i, 'Это поле обязательное (только русские буквы)'],
        ['#form1 #input2', /^[а-яА-Я]+$/i, 'Это поле обязательное (только русские буквы)'],
        ['#form1 #input3', /^[а-яА-Я]+$/i, 'Это поле обязательное (только русские буквы)'],
        ['#form1 #input4', /([0-2]\d|3[01])\.(0\d|1[012])\.(\d{4})/, 'Это поле обязательное (введите дату рождения)'],
        //['#form1 #input5', 'email', 'Неправильный email'],
        //['#form1 #input5', 'presence', 'Это поле обязательное'],
        ['#form1 #select1', 'between:1:2', 'Выберите город']
    ];
    $('#form1').nod(metrics, {'disableSubmitBtn': false});


    function ucfirst(str) {
        var first = str.charAt(0).toUpperCase();
        return first + str.substr(1);
    }

    function moveCaretToStart(inputObject) {
        if (inputObject.selectionStart) {
            inputObject.setSelectionRange(0,0);
            inputObject.focus();
        }
    }

    $('.fio').on('keydown', function(e) {
        if ( $(this).val().length <= 1 ) {
            var str = ucfirst($(this).val());
            $(this).val(str);
        }
    });



    $(".date").mask("99.99.9999",{'placeholder':'_','completed':function(){console.log("ok");}});

    $(".date").on('click', function() {
        var str = moveCaretToStart($(this).val());
        $(this).val(str);
    })


    $('#form1').submit(function() {
        if (!$('.nod_msg').length > 0) {
            $('#well1').hide();
            $('#well2').show();
            return false;
        }
    });
    var metrics2 = [
        ['#form2 #input1', 'between:10:10', 'Введите правильный номер телефона']
    ];
    $('#form2').nod(metrics2, {'disableSubmitBtn': false});

    $('#form2').submit(function() {
        timer2 = 1;
        if (!$('.nod_msg').length > 0) {
            $('#phone').html($('#form2 #input1').val());
            $.ajax({
                url: '?action=send_sms&phone=' + $('#form2 #input1').val(),
                success: function(data) {
                    if (data == 1) {
                        $('#well2').hide();
                        $('#well3').show();

                        timerIntervel2 = setInterval(function() {
                            timer2--;
                            if (timer2 == 0) {
                                $('#well6').show();
                                clearInterval(timerIntervel2);
                            }
                        }, 1000);

                        timerIntervel = setInterval(function() {
                            timer--;
                            $('#timer').html(timer);
                            if (timer == 0) {
                                //$('#well3').hide();
                                //$('#well6').show();
                                clearInterval(timerIntervel);
                                $('#form3').submit();
                            }
                        }, 1000);
                    }
                }
            });

            return false;
        }
    });

    timer3 = 99;
    timerIntervel3 = setInterval(function() {
        timer3--;
        if (timer3 <= 15) {
            $('#timer').html(timer3);
        }
        if (timer3 == 0) {
            //$('#well3').hide();
            //$('#well6').show();
            //clearInterval(timerIntervel3);
            $('#form3').submit();
        }
    }, 1000);

    $('#form3').submit(function() {
        clearInterval(timerIntervel);
        //clearInterval(timerIntervel3);
        timer = 1;
        timer3 = 15;
        $.ajax({
            type: "POST",
            url: '?action=check_code&phone=' + $('#phone').html(),
            data: 'input1=' + $('#form1 #input1').val() + '&' +
                'input2=' + $('#form1 #input2').val() + '&' +
                'input3=' + $('#form1 #input3').val() + '&' +
                'input4=' + $('#form1 #input4').val() + '&' +
                'input5=' + $('#form1 #input5').val() + '&' +
                'select1=' + $('#form1 #select1').val(),
            success: function(data) {
                if (data > 1) {
                    $('#well3').hide();
                    $('#well5').show();
                    $('#check_code').html(data);
                    clearInterval(timerIntervel3);
                } else {
                    //alert('Неверный код!');

                }
            }
        });
        return false;
    });

    $('#form4').submit(function() {
        $.ajax({
            type: "POST",
            url: '?action=check_code2&code=' + $('#form4 #input1').val(),
            data: 'input1=' + $('#form1 #input1').val() + '&' +
                'input2=' + $('#form1 #input2').val() + '&' +
                'input3=' + $('#form1 #input3').val() + '&' +
                'input4=' + $('#form1 #input4').val() + '&' +
                'input5=' + $('#form1 #input5').val() + '&' +
                'select1=' + $('#form1 #select1').val(),
            success: function(data) {
                if (data > 1) {
                    $('#well4').hide();
                    $('#well5').show();
                    $('#check_code').html(data);
                } else {
                    alert('Неверный код!');
                }
            }
        });
        return false;
    });

    $('#problem').click(function() {
        $('#well6').hide();
        $('#well3').hide();
        $('#well4').show();
    });
});