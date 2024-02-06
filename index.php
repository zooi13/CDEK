<form method="post" action="pvz_action.php">
    <input type="hidden" name="pvz" placeholder="Код ПВЗ">
    <a href="javascript:void(0)" onclick="widjet.open()">Выберите пункт выдачи</a>
    <br><br>
    <input type="text" name="address" readonly="readonly" placeholder="Адрес ПВЗ">


    <p>Имя получателя:</p>
    <input type="text" name="name" placeholder="Имя получателя">
    <p>Телефон получателя:</p>
    <input type="text" name="phone" placeholder="Телефон получателя">
    <p>Email получателя:</p>
    <input type="text" name="email" placeholder="Email получателя">
    <br><br>
    <button type="submit" class="btn btn-primary">Продолжить</button>
</form>



<script id="ISDEKscript" type="text/javascript" src="https://widget.cdek.ru/widget/widjet.js" charset="utf-8"></script>
<script>
    var widjet = new ISDEKWidjet({
        popup: true,
        hidedelt: true,
        defaultCity: 'Москва',
        cityFrom: 'Москва',
        onReady: function(){
            ipjq('#linkForWidjet').css('display','inline');
        },
        onChoose: function(info){
            ipjq('[name="pvz"]').val(info.id);
            ipjq('[name="address"]').val(' г.' + info.cityName + ', ' + info.PVZ.Address);
            //console.dir(info);
            widjet.close();
        }
    });
</script>
