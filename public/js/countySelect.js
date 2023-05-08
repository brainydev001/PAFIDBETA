/**
 * Module : County Select
 * =========================================================
 * Has two select forms (.select-county & .select-subcounty)
 * select a county and it populates it's subcounties
 * =========================================================
 * NOTE: counties json file is required              
 */


var countySelect = (function() {

    let $county = $('.select-county');

    let $subcounty = $('.select-subcounty');
    let jsonFileUrl = window.location.origin + '/json/counties.json';

    function init() {
        setCounties();
        setSubCounties();
        eventBinding();
    }

    // event binding
    function eventBinding() {
        $county.on('change', setSubCounties);
    }

    // set counties
    function setCounties() {
        $.getJSON(jsonFileUrl, function(counties) {
            counties.forEach(county => {
                $county.append(
                    `<option ${county.name == old_countySelect.county ? 'selected' : ''} value="${county.name}">${county.name}</option>`
                );
            });
        });
    }

    // set sub_counties
    function setSubCounties() {
        // $subcounty.parent().find('label').html(spinner());
        $subcounty.html(`<option value="" disabled selected>Select subcounty</option>`);

        $.getJSON(jsonFileUrl, function(counties) {
            const result = counties.filter(function(county) {
                return county.name == $county.val();
            });
            result[0].sub_counties.forEach(sub_county => {
                $subcounty.append(
                    `<option ${sub_county == old_countySelect.sub_county ? 'selected' : ''} value="${sub_county}">${sub_county}</option>`
                );
            });
        });

        setTimeout(function() {
            $subcounty.parent().find('label').html('Sub county');
        }, 300);
    }

    init();

})();