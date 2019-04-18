/*
	 JavaScript, increase & decrease input field value. -  April 28, 2013
	(c) 2013 @ElmahdiMahmoud - fikra-masri.by
	license: https://www.opensource.org/licenses/mit-license.php
*/
$(function () {

    set_($('#three-max'), 3);  //return 3 maximum digites
    set_($('#six-max'), 6);    //return 6 maximum digites
    set_($('#nine-max'), 9);  //return 9 maximum digites

    function set_(_this, max) {
        var block = _this.parent();

        block.find(".increase").click(function () {
            var currentVal = parseInt(_this.val());
            if (currentVal != NaN && (currentVal + 1) <= max) {
                _this.val(currentVal + 1);
            }
        });

        block.find(".decrease").click(function () {
            var currentVal = parseInt(_this.val());
            if (currentVal != NaN && currentVal != 0) {
                _this.val(currentVal - 1);
            }
        });
    }
});