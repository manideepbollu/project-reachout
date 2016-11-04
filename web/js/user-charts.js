var charts = function () {


    var browserData = [
        {
            label: "Teachers",
            data: 15,
            color: "#848ca1"
        },
        {
            label: "Other Staff",
            data: 10,
            color: "#767f96"
        },
        {
            label: "Students",
            data: 57,
            color: "#697289"
        },
        {
            label: "Parents",
            data: 15,
            color: "#5e667a"
        },
        {
            label: "Admins",
            data: 3,
            color: "#535a6c"
        }
    ];



    function initFlot() {
        $.plot($(".flot-pie"), browserData, {
            series: {
                pie: {
                    show: true
                }
            },
            legend: {
                show: false
            },
            grid: {
                hoverable: true
            },
            stroke: {
                width: 0
            }
        });

    }

    function initEastPie() {

        $('.total').easyPieChart({
            size: 150,
            lineWidth: 12,
            barColor: '#FFB244',
            trackColor: '#F3F5F8',
            lineCap: 'square',
            easing: 'easeOut',
            animate: 4000,
            scaleColor: false,
            onStep: function (from, to, percent) {
                $(this.el).find('.percent').text(Math.round(percent));
            }
        });

        $(".piechart").each(function () {
            var canvas = $(this).find("canvas");
            $(this).css({
                "width": canvas.width(),
                "height": canvas.height()
            });
        });
    }

    return {
        init: function () {
            initFlot();
            initEastPie();
        }
    };
}();

$(function () {
    "use strict";
    charts.init();
});