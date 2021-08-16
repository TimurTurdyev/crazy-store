<div class="col-12 col-md-8 offset-md-2">

    <div id="ecom-widget-courier" style="height: 500px;">
        <script src="https://widget.pochta.ru/courier/widget/widget.js"></script>
        <script>
            function callbackPochta() {
                console.log(this)
            }
            courierStartWidget({
                id: 15988,
                callbackFunction: callbackPochta,
                containerId: 'ecom-widget-courier'
            });
        </script>
    </div>
    <div id="ecom-widget" style="height: 500px">
        <script src="https://widget.pochta.ru/map/widget/widget.js"></script>
        <script>
            ecomStartWidget({
                id: 15987,
                callbackFunction: callbackPochta,
                containerId: 'ecom-widget'
            });
        </script>
    </div>
</div>
