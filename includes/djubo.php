kumar
<script>
    $(document).ready(function(){
        var resultObject;

        function searchResult(nameKey, myArray){
            for (var i=0; i < myArray.length; i++) {
                if (myArray[i].id === nameKey) {
                    return myArray[i];
                }
            }
        }

        if (!resource) {
            $.getJSON("/data/resort.json", function(json) {
                resultObject = searchResult(resource.id, json);
                console.log('11111')
                console.log(resultObject);
            });
        } else {
            //for other page
        }
          
    })
</script>