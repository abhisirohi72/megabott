<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <select name="crypto_currency" id="crypto_currency" class="form-control mb-2">
        <option value="bitcoin">Bitcoin</option>
        <option value="ethereum">Ethereum</option>
        <option value="tether">Tether</option>
        <option value="solana">Solana</option>
        <option value="dogecoin">Dogecoin</option>
        <option value="ripple">XRP</option>
        <option value="usd-coin">USDC</option>
        <option value="cardano">Cardano</option>
        <option value="shiba-inu">Shiba Inu</option>
    </select>
    <button onclick="startCron()" class="btn btn-sm btn-primary">Start</button>
    <button onclick="stopCron()" class="btn btn-sm btn-primary">Stop</button>
    <script>
        function startCron(){
            var crypto_val = document.getElementById("crypto_currency").value;
            $.ajax({
                type: "POST",
                url: "{{ route('admin.trade.cryptoSave') }}", // Correct route name
                data: { data: crypto_val },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response);
                    if(response==1){
                        alert("successfully insterted");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        function stopCron(){
            var crypto_val = document.getElementById("crypto_currency").value;
            $.ajax({
                type: "POST",
                url: "{{ route('admin.trade.stopCryptoSave') }}", // Correct route name
                data: { data: crypto_val },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response);
                    if(response==1){
                        alert("successfully insterted");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    </script>
</body>
</html>