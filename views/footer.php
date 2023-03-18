<!-- JAVASCRIPT STARTS -->
<script>
    var lang = navigator.language.slice(0, 2) || navigator.userLanguage.slice(0, 2)

    if (( lang == 'es' ) || ( lang == 'fi' )) {
        var language = new XMLHttpRequest()
        language.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var myObj = JSON.parse(this.responseText)
                    document.getElementById("h3_0").innerHTML = myObj.h3[0]
                    document.getElementById("h3_1").innerHTML = myObj.h3[1]
                    document.getElementById("th_0").innerHTML = myObj.th[0]
                    document.getElementById("th_1").innerHTML = myObj.th[1]
                    document.getElementById("th_2").innerHTML = myObj.th[2]
                    document.getElementById("th_3").innerHTML = myObj.th[3]
                    document.getElementById("th_4").innerHTML = myObj.th[4]
                    document.getElementById("form_0").innerHTML = myObj.form[0]
                    document.getElementById("form_1").innerHTML = myObj.form[1]
                    document.getElementById("form_2").innerHTML = myObj.form[2]
                    document.getElementById("form_3").innerHTML = myObj.form[3]
                    document.getElementById("form_4").innerHTML = myObj.form[4]
                    document.getElementById("send").innerHTML = myObj.send
                }
        }
        language.open("GET", "lang." + lang +".json", true)
        language.send()
    }
</script>
</body>
</html>
