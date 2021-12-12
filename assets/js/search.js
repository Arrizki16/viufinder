function getSearchString(inputId, isRange) {
    let element = document.getElementById(inputId);
    let searchString = () => {
        if (element != null && element.value != '') {
            return element.value;
        } else {   
            return "";
        }
    }
    let searchStringValue = searchString();
    if (searchStringValue == "") {
        if(isRange) {
            var minRange = "&min" + inputId + "=" + 0;
            var maxRange = "&max" + inputId + "=" + 1000000;
            return "";
        }
        return "";
    } else {
        console.log(searchStringValue);
        if (isRange) {
            let range = searchStringValue.match(/\d+/g);
            console.log(range);
            let minRange = "&min" + inputId + "=" + range[0];
            let maxRange = "&max" + inputId + "=" + range[1];
            return minRange + maxRange;
        }
        searchStringValue = searchStringValue.replace(/\s/g, "+");
        return "&" + inputId + "=" + searchStringValue;
    }
};

function search() {
    console.log("search");
    let path = window.location.pathname;
    let searchUrl = path + "?";
    let name = getSearchString("nama", false).slice(1);
    let location = getSearchString("lokasi", false);
    let category = getSearchString("kategori", false);
    let rating = getSearchString("rating", true);

    searchUrl += name + location + category + rating;
    console.log(searchUrl);
    window.location.replace(searchUrl);
};

function search2() {
    console.log("search2")
}