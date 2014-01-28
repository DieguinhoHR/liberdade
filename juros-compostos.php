<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="Chart.js/Chart.js"></script>
    </head>
    <body>
        <canvas id="myChart" width="400" height="400"></canvas>
        <form id="Juros" method="post" action="calcular-juros.php">
            <label for="Capital">Capital</label>
            <input type="text" id="Capital" name="capital"/>
            <label for="Time">Time</label>
            <input type="text" id="Time" name="time"/>
            <label for="Rate">Rate</label>
            <input type="text" id="Rate" name="rate"/>
            <label for="Sum">Sum</label>
            <input type="text" id="Sum" name="sum"/>
            <label for="Operation">Operation</label>
            <select name="operation" id="Operation">
                <option></option>
                <option value="1">Calculate Sum</option>
                <option value="2">Calculate Capital</option>
                <option value="3">Calculate Rate</option>
                <option value="4">Calculate Time</option>
            </select>
            <input type="submit" value="Enviar"/>
            <input type="button" id="Limpar" value="Limpar"/>
        </form>
        <script>
            $(function(){
            	$(document).delegate( "#Juros"    , "submit" , ajaxJuros );  /** #1.1.3 */
            	$(document).delegate( "#Limpar"    , "click" , ajaxLimpar );  /** #1.1.3 */
            });

            var ajax = function(url,data,callback)
            {
            	 return $.ajax({
                     'url'     : url,
                     'data'    : data,
                     'type'    : 'POST',
                     'success' : callback
                 });
            }
            
            var ajaxLimparSucesso = function()
            {
                //alert('limpado com sucesso');

            }

            var ajaxLimpar = function(e)
            {
            	//$('#Juros')[0].reset();
            	ajax('limpar.php',null,ajaxLimparSucesso);
            }


            function randomColorLine(dataset)
            {

            }
            
            function grayLine(dataset)
            {
                return {
					fillColor : "rgba(220,220,220,0.5)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					data : dataset
				};
            }
            function blueLine(dataset)
            {
            	return {
                	fillColor : "rgba(151,187,205,0.5)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					data : dataset
                };

            }
        	
            var ajaxJuros = function(e)
            {
            	 e.preventDefault();
            	 ajax('calcular-juros.php',$('#Juros').serialize(),ajaxSuccessFunction);
            }

            function balanceToDataset(balance)
            {
                var dataset = [];
                for(i = 0; i < balance.length; i++)
                {
                	dataset.push(blueLine(balance[i]));
                    //console.log(blueLine(balance[i]));
                    //
                }
                return dataset;
            	//console.log(balance.length);
            }

            function rainbow(numOfSteps, step) {
                // This function generates vibrant, "evenly spaced" colours (i.e. no clustering). This is ideal for creating easily distinguishable vibrant markers in Google Maps and other apps.
                // Adam Cole, 2011-Sept-14
                // HSV to RBG adapted from: http://mjijackson.com/2008/02/rgb-to-hsl-and-rgb-to-hsv-color-model-conversion-algorithms-in-javascript
                var r, g, b;
                var h = step / numOfSteps;
                var i = ~~(h * 6);
                var f = h * 6 - i;
                var q = 1 - f;
                switch(i % 6){
                    case 0: r = 1, g = f, b = 0; break;
                    case 1: r = q, g = 1, b = 0; break;
                    case 2: r = 0, g = 1, b = f; break;
                    case 3: r = 0, g = q, b = 1; break;
                    case 4: r = f, g = 0, b = 1; break;
                    case 5: r = 1, g = 0, b = q; break;
                }
                var c = "#" + ("00" + (~ ~(r * 255)).toString(16)).slice(-2) + ("00" + (~ ~(g * 255)).toString(16)).slice(-2) + ("00" + (~ ~(b * 255)).toString(16)).slice(-2);
                return (c);
            }
            
            function chartToObject(data)
            {
                var char_data = jQuery.parseJSON(data);

                //console.log(char_data.label);
                //console.log(char_data.balance);

                
                
            	var data = {
            			labels : char_data.label,
            			datasets :	balanceToDataset(char_data.balance),
            			
            	}
            	var ctx = document.getElementById("myChart").getContext("2d");
        		var chart = new Chart(ctx).Line(data);
            }

            var ajaxSuccessFunction = function(data)
            {
            	chartToObject(data);
            }

            
        </script>
    </body>
</html>
