
//- Жмем на поле "Сдача с купюры"
$('.js-order-change-toggler').on('click', function(event){
    event.preventDefault();

    $('.js-order-change').toggleClass('is--active');
});

//- Жмем на элемент в поле "Сдача с купюры"
$('.js-order-change-item').on('click', function(event){
    event.preventDefault();

    //- считываем выбранное значение
    var changeValue = $(this).data('value')
    //- активируем выбранный элемент
    $('.js-order-change-item').removeClass('is--active');
    $(this).addClass('is--active');
    //- возвращаем выбранное значение и закрываем блок выбора
    $('.js-order-change-toggler')
        .text(changeValue)
        .find('input').val(changeValue);
    $('.js-order-change').toggleClass('is--active');
});




//- Жмем на поле даты - показываем блок выбора даты
$('.js-choose-date-toggler').on('click', function(event){
    event.preventDefault();

    $('.js-choose-date').toggleClass('is--active');
});
//- Жмем на кнопку установить - ззакрываем блок выбора, устанавливаем выбранное значение
$('.js-choose-date-action').on('click', function(event){
    event.preventDefault();

    var fullDate = getFullDate( $('.js-choose-date') );
    var fullDateString = fullDate.year + '-' + fullDate.monthIndex + '-' + fullDate.day + ' ' + fullDate.hours + ':' + fullDate.minutes;

    $('.js-choose-date-toggler')
        .text(fullDateString)
        .find('input').val(fullDateString);
    $('.js-choose-date').toggleClass('is--active');
});
$('.js-choose-date-change').on('click', function(){
    var $dateSelected = $('.js-choose-date-title');
    var $dateChoose = $('.js-choose-date');
    var $dateItemValue = $(this).parent().find('.js-choose-date-value');
    var monthIndex = $dateItemValue.data('index');
    var type = $dateItemValue.data('type');
    var newValue = $dateItemValue.text();
    var sign = ($(this).data('incriment')==='minus')?-1:1;

    //- Если это не поле месяца, обрабатываем цифровое значение
    if (monthIndex !== undefined){
        var newMonthIndex = getNewValue(type, parseInt(monthIndex)+sign);

        newValue = getMonthName(newMonthIndex);
        setMonthIndex($dateItemValue, newMonthIndex);
    } else {
        newValue = getNewValue(type, parseInt(newValue) + sign);
    }

    $dateItemValue.text(newValue);

    //- Получим значение всей даты в виде строки
    var fullDate = getFullDate( $('.js-choose-date') );
    var dayName = getDayName(fullDate.year+' '+fullDate.monthIndex+' '+fullDate.day);
    var fullDateString = dayName + ', ' + fullDate.month + ' ' + fullDate.day + ', ' + fullDate.year + ' ' + fullDate.hours + ':' + fullDate.minutes;

    $dateSelected.text( fullDateString );
});

//- Получаем значение всей даты в виде строки
function getFullDate(elem){
    var monthName = elem.find('[data-type="month"]').text();
    var fullDate = {
        year: elem.find('[data-type="year"]').text(),
        month: monthName,
        monthIndex: getMonthIndex(monthName)+1,
        day: elem.find('[data-type="day"]').text(),
        hours: elem.find('[data-type="hours"]').text(),
        minutes: elem.find('[data-type="minutes"]').text()
    }

    return fullDate;
}

//- Получаем новое значение в зависимости от типа данных
function getNewValue(type, value){
    switch (type) {
        case 'year':
            var limit = {
                min: 2017,
                max: 2018
            }
            break;
        case 'month':
            var limit = {
                min: 0,
                max: 11
            }

            break;
        case 'day':
            var limit = {
                min: 1,
                max: 31
            }
            break;
        case 'hours':
            var limit = {
                min: 1,
                max: 24
            }
            break;
        case 'minutes':
            var limit = {
                min: 0,
                max: 59
            }
            break;

        default:
            break;
    }

    if ( value > limit.max ) {
        value = limit.min;
    }
    if ( value < limit.min ) {
        value = limit.max;
    }

    return parseInt(value);
}

//- Получаем название месяца
function getMonthName(index){
    var monthes = ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'];

    return monthes[index];
}

//- Получаем индекс месяца
function getMonthIndex(monthName){
    var monthes = ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'];

    return monthes.indexOf(monthName);
}

//- Получаем название дня
function getDayName(dateString){
    var days = ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'];
    var d = new Date(dateString);
    var dayName = days[d.getDay()];

    return dayName;
}

//- Устанавливаем индекс значение для месяца = индексу в массиве месяцев
function setMonthIndex(elem, index){
    elem.data('index', index);
}
