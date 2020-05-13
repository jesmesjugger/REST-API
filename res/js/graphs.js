$(document).ready(function(){
    //resize divs from half-size to full
    // $(window).bind("load resize", function () {
    //     if ($(this).width() <= 1024) {
    //         $('div.svg_div').removeClass('col-md-6');
    //         $('div.svg_div').addClass('col-md-12')
    //     } else {
    //         $('div.svg_div').removeClass('col-md-12');
    //         $('div.svg_div').addClass('col-md-6')
    //     }
    // });

    $.ajax({
        url: "../../include/d3_data.php",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json",
          },
        dataType: "JSON",
        success: function(data){
            loadTransactionGraph(data.trans_link);
            loadInquiryGraph(data.inquiry_link)
        },
        error: function(resp) {
            console.log(resp);
        }
    });

});

/**
 * FUNCTIONS
 */
function loadTransactionGraph(link){
    var svg = d3.select("#transaction-graph").select("svg"),
        margin  = {top: 50, right: 20, bottom: 30, left: 50},
        width   = svg.attr("width")  - margin.left - margin.right,
        height  = svg.attr("height") - margin.top  - margin.bottom,
        xScale  = d3.scaleBand().rangeRound([0, width]).padding(0.2),
        yScale  = d3.scaleLinear().rangeRound([height, 0]),
        g       = svg.append("g")
                    .attr("transform", `translate(${margin.left},${margin.top})`);

    d3.json(link).then(data => {
        let reqData = data.RequestData;
        var fwcount=0,
            pwcount=0,
            fnclaim=0;

        for(var i=0; i<reqData.length; i++){
            if(reqData[i].transaction_type_description == "Full Withdrawal"){
                fwcount +=1;
            }
            else if(reqData[i].transaction_type_description == "Partial Withdrawal"){
                pwcount +=1;
            }
            else if(reqData[i].transaction_type_description == "Funeral Claim"){
                fnclaim +=1;
            }
        }
    
        var f_data= [
            {"transaction_type" :"Full Withdrawal", "quantity" :fwcount},
            {"transaction_type" :"Partial Withdrawal","quantity" :pwcount},
            {"transaction_type" :"Funeral Claim","quantity" :fnclaim}
        ],
        schemeSet1 = d3.scaleOrdinal().range(d3.schemeSet1),
        tooltip = d3.select("#transaction-graph")
        .append("div")
        .attr("class","d3-tooltip");
    
        xScale.domain(f_data.map(d => d.transaction_type));
        yScale.domain([0, d3.max(f_data, d => d.quantity)]);

        g.append("g")
            .attr("class", "axis axis-x")
            .attr("transform", `translate(0,${height})`)
            .call(d3.axisBottom(xScale));
        
        g.append("g")
            .attr("class", "axis axis-y")
            .call(d3.axisLeft(yScale))
            .append("text")
            .attr("transform","rotate(-90)")
            .attr("y", 6)
            .attr("dy", "0.71em")
            .attr("text-anchor", "end")
            .attr("fill", "#5D6971")
            .text("Number of Transactions");
        
        g.selectAll(".bar")
            .data(f_data)
            .enter().append("rect")
            .attr("class", "bar")
            .attr("x", d => xScale(d.transaction_type))
            .attr("y", d => yScale(d.quantity))
            .attr("width", xScale.bandwidth())
            .attr("height", d => height - yScale(d.quantity))
            .attr("fill",(d,i)=>schemeSet1(i))
            .on("mouseover",function(d){
                d3.select(this).attr('fill','#004445');
                tooltip.style("visibility", "visible");
            })
            .on("mousemove",function(d){
                tooltip
                .style("left", (d3.mouse(this)[0]+20) + "px")
                .style("top", (d3.mouse(this)[1]+25) + "px")
                .html(d.quantity+" transactions");
            })
            .on("mouseout",function(d,i){
                d3.select(this).attr('fill',schemeSet1(i));
                tooltip.style("visibility", "hidden");
            });
        
        svg.append("text")
            .attr("transform", "translate(100,0)")
            .attr("x", 40)
            .attr("y", 30)
            .attr("font-size", "24px")
            .text("Transaction Types");
    })
    .catch(err => {
    svg.append("text")         
            .attr("y", 20)
            .attr("text-anchor", "left")  
            .style("font-size", "20px") 
            .style("font-weight", "bold")  
            .text(`Couldn't open the data file: "${err}".`);
    });
}

function loadInquiryGraph(link){
    var svg = d3.select("#inquiry-graph").select("svg"),
        margin  = {top: 50, right: 20, bottom: 30, left: 50},
        width   = svg.attr("width")  - margin.left - margin.right,
        height  = svg.attr("height") - margin.top  - margin.bottom,
        xScale  = d3.scaleBand().rangeRound([0, width]).padding(0.2),
        yScale  = d3.scaleLinear().rangeRound([height, 0]),
        g       = svg.append("g")
                    .attr("transform", `translate(${margin.left},${margin.top})`);

    d3.json(link).then(data => {
        let reqData = data.RequestData;
        var fiCount=0,
            piCount=0;

        for(var i=0; i<reqData.length; i++){
            if(reqData[i].inquiry_type == "Funeral Inquiry"){
                fiCount +=1;
            }
            else if(reqData[i].inquiry_type == "Personal Inquiry"){
                piCount +=1;
            }
        }
        
        var f_data = [
            {"inquiry_type" :"Funeral", "quantity" :fiCount},
            {"inquiry_type" :"Personal","quantity" :piCount},
        ],
        schemeCategory10 = d3.scaleOrdinal().range(d3.schemeCategory10),
        tooltip = d3.select("#inquiry-graph")
        .append("div")
        .attr("class","d3-tooltip");

        xScale.domain(f_data.map(d => d.inquiry_type));
        yScale.domain([0, d3.max(f_data, d => d.quantity)]);

        g.append("g")
            .attr("transform", `translate(0,${height})`)
            .call(d3.axisBottom(xScale));
        
        g.append("g")
            .call(d3.axisLeft(yScale))
            .append("text")
            .attr("transform","rotate(-90)")
            .attr("y", 6)
            .attr("dy", "0.71em")
            .attr("text-anchor", "end")
            .attr("fill", "#5D6971")
            .text("Number of Inquiries");
        
        g.selectAll(".bar")
            .data(f_data)
            .enter().append("rect")
            .attr("class", "bar")
            .attr("x", d => xScale(d.inquiry_type))
            .attr("y", d => yScale(d.quantity))
            .attr("width", xScale.bandwidth())
            .attr("height", d => height - yScale(d.quantity))
            .attr("fill",(d,i)=>schemeCategory10(i))
            .on("mouseover",function(d){
                d3.select(this).attr('fill','#004445');
                tooltip.style("visibility", "visible");
            })
            .on("mousemove",function(d){
                tooltip
                .style("left", (d3.mouse(this)[0]+20) + "px")
                .style("top", (d3.mouse(this)[1]+25) + "px")
                .html(d.quantity+" inquiries");
            })
            .on("mouseout",function(d,i){
                d3.select(this).attr('fill',schemeCategory10(i));
                tooltip.style("visibility", "hidden");
            });

        svg.append("text")
            .attr("transform", "translate(100,0)")
            .attr("x", 60)
            .attr("y", 30)
            .attr("font-size", "24px")
            .text("Inquiry Types");
    })
    .catch(err => {
    svg.append("text")         
            .attr("y", 20)
            .attr("text-anchor", "left")  
            .style("font-size", "20px") 
            .style("font-weight", "bold")  
            .text(`Couldn't open the data file:"${err}".`);
    });
}