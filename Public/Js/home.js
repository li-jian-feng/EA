$(function () {
    $('#my_charts').highcharts({
        title: {
            useHTML:true,
            text: '<span id="toggle_time_a" title="点击切换" style="border:1px solid #ccc;">近1年</span> 统计图'
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: '人民币 (万元)'
            }
        },
        exporting:{
            enabled:false
        },
        credits:{
            enabled:false
        },
        tooltip: {
            valueSuffix: ' 万元',
            shared:true
        },
        series: [{
            name: '销售金额',
            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        }, {
            name: '销售毛利',
            data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
        }, {
            name: '费用',
            data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
        }]
    });
    $('#toggle_time_a').click(function(){
    	var tt = $(this).text();
    	var chart = $('#my_charts').highcharts();
    	if(tt == '近1年'){
    		$(this).text('近半年');
    		chart.xAxis[0].setCategories(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']);
    		chart.series[0].setData([7.0, 6.9, 9.5, 14.5, 18.2, 21.5]);
    		chart.series[1].setData([-0.2, 0.8, 5.7, 11.3, 17.0, 22.0]);
    		chart.series[2].setData([-0.9, 0.6, 3.5, 8.4, 13.5, 17.0]);
    	}else{
    		$(this).text('近1年');
    		chart.xAxis[0].setCategories(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);
    		chart.series[0].setData([7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]);
    		chart.series[1].setData([-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]);
    		chart.series[2].setData([-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]);
    	}
	});
});