$(document).ready(function(){

    /**
     * Navbar Resize
     */
    $(window).bind("load resize", function () {
        if ($(this).width() < 768) {
            $('div.sidebar-collapse').addClass('collapse')
            $('#navToggler').removeClass('hidden');
        } else {
            $('div.sidebar-collapse').removeClass('collapse')
            $('#navToggler').addClass('hidden');
        }
    });


    /**
     * Datatables
     */
    $('#transactionTable').DataTable({
        "iDisplayLenth" :  5,
        "aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
        dom: 'lBfrtip',
        processing: true, //shows progress bar
        buttons: [
            {
                text: 'Export to Excel',
                extend: 'excel',
                className: "ml-2 py-1 px-1",
                title: `Transaction Records - ${new Date().getTime().toString()}`
            }
            
        ]
    });

    $('#inquiryTable').DataTable({
        "iDisplayLenth" :  5,
        "aLengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
        dom: 'lBfrtip',
        processing: true, //shows progress bar
        buttons: [
            {
                text: 'Export to Excel',
                extend: 'excel',
                className: 'ml-2 py-1 px-1',
                title: `Inquiry Records - ${new Date().getTime().toString()}`
            }
        ]
    });


    /**
     * D3 Data visualization
     */

    var chartdata = [40, 60, 80, 100, 70, 120, 100, 60, 70, 150, 120, 140];
    //  the size of the overall svg element
    var svg_height = 200, svg_width = 750,

    //  the width of each bar and the offset between each bar
        barWidth = (svg_width/chartdata.length),
        barOffset = 5;

    d3.select('#graph-1').append('svg')
    .attr('width', svg_width)
    .attr('height', svg_height)
    .style('background', '#cecece')
    .selectAll('rect')
    .data(chartdata)
    .enter()
    .append('rect')
    .style('fill', '#212121')
        .attr('width', barWidth-barOffset)
        .attr('height', data => data) //actual values of the data
        .attr('y', function (data) {
            //svg height  - attr('height')
            return svg_height - data;
        })
        .attr('transform',(data,index)=>{
            var translate = [barWidth * index, 0];
            return "translate("+translate+")";
        });
    
});