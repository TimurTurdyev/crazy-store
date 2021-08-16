<button type="button" class="btn btn-link" onclick="widjetCdek.open();">Открыть выбор</button>

<textarea class="form-control form-control-sm mb-9 mb-md-0 font-size-xs"
          rows="5"
          placeholder="Комментарий к заказу (не обязательное поле)"></textarea>
<script id="ISDEKscript" type="text/javascript" src="widget/widjet.js"></script>
<script>
    var widjetCdek = new ISDEKWidjet({
        popup: true,
        path: '{{ asset('widget/scripts') }}/',
        servicepath: '{{ route('cdek_widget.info') }}',
        templatepath: '{{ route('cdek_widget.template') }}',
        hideMessages: false,
        defaultCity: 'auto',
        cityFrom: 'Мытищи',
        choose: true,
        // link: 'forpvz',
        hidedress: true,
        hidecash: true,
        detailAddress: true,
        goods: [{
            length: 10,
            width: 10,
            height: 10,
            weight: 1
        }],
        onReady: onReady,
        onChoose: onChoose,
        onChooseProfile: onChooseProfile,
        onChooseAddress: onChooseAddress,
        onCalculate: onCalculate
    });

    function onReady() {
        console.log('ready');
    }

    function onChoose(wat) {
        console.log('chosen ', wat);
    }

    function onChooseProfile(wat) {
        console.log('chosenCourier ', wat);
    }

    function onChooseAddress(wat) {
        console.log('chosenAddress ', wat);
    }

    function onCalculate(wat) {
        console.log('calculated ', wat);
    }
</script>
