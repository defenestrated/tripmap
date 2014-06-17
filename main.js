// add any scripting here

var parchment, ww, wh, projection;

$(document).ready(function() {

    ww = $(window).width(), wh = $(window).height();

    sizefix();

    parchment = d3.select(".parchment");

    loadjson();

    registerEvents();
});


function sizefix() {
}

function registerEvents() {
    $("#closepost").on("click", function() {
        $(".postviewer").fadeOut(800, "easeOutCubic");
    });
}

function pullposts(mapdata) {
    $.ajax({
        url: "wordpress/wp_api/v1/posts",
        success: function(postdata) {
            booty(postdata, mapdata);
        }
    });
}


function loadjson() {
    d3.json("assets/usa.json", function(error, usa) {
        if (error) return console.error(error);
        console.log(usa);

        boob(usa);
    });
}

function boob(nipple) {

    var subunits = topojson.feature(nipple, nipple.objects.subunits);
    projection = d3.geo.albers()
        .scale(1200)
        .translate([ww/2, wh/2])
    ;

    var path = d3.geo.path()
            .projection(projection);

    mapstuff = parchment.append("g").attr("class", "map-data");

    // parchment.append("path")
    //     .datum(subunits)
    //     .attr("d", path);

    mapstuff.selectAll(".pieceoland")
        .data(topojson.feature(nipple, nipple.objects.subunits).features)
        .enter().append("path")
        .attr("class", function(d) { return "pieceoland " + d.id; })
        .attr("d", path)
    ;

    pullposts(nipple);

}


function booty(thang, junk) {
    console.log(thang);

    var dots = parchment.append("g").attr("class", "goodies");

    var linepoints = [];

    _(thang.posts).each(function(ell, ix) {
        // console.log(ell);
        var datapoints = dots.selectAll("g")
                .data(thang.posts)
                .enter().append("g")
                .attr("class", function(d) { return "datapoint " + d.name; })
        ;

        datapoints.each(function(d, i) {
            d3.select(this).append("circle")
                .attr("class", "dot")
                .attr("r", "5px")
                .attr("transform", function(d) {
                    linepoints.push(projection([d.geodata.longitude, d.geodata.latitude]));
                    return "translate(" + projection([d.geodata.longitude, d.geodata.latitude]) + ")";
                })
                .on("mouseenter", function(d) {
                    d3.select(this).transition()
                        .duration(200)
                    // .attr("r", "20px")
                        .style("fill", "white")
                    ;
                    $(".datapoint:not(." + d.name + "), .weenie").animate({
                        opacity: 0.3
                    }, 200);
                    $(".label." + d.name).fadeIn(200);
                })
                .on("mouseleave", function(d) {
                    d3.select(this).transition()
                        .duration(200)
                    // .attr("r", "8px")
                        .style("fill", "darkblue")
                    ;
                    $(".label." + d.name).fadeOut(200);
                    $(".datapoint, .weenie").animate({
                        opacity: 1
                    }, 200);
                })
                .on("click", function(d) {
                    $(".postnuggets").html("");
                    var post = d3.select(".postnuggets");
                    post.append("h1").html(d.title);
                    post.append("h2").html(function() {
                        var thedate = moment(d.date).format("MMMM Do, h:mma");
                        return thedate + " <span class='sep'>//</span> " + d.geodata.address;
                        // return d.geodata.address;
                    });
                    post.append("div")
                        .attr("class", "content")
                        .html(d.content_display)
                    ;

                    $(".postviewer").fadeIn(100);
                })
            ;

            d3.select(this).append("text")
                .attr("class", function(d) { return "label " + d.name; })
                .attr("x", function(d) {
                    return projection([d.geodata.longitude, d.geodata.latitude])[0] + 20 + "px";
                })
                .attr("y", function(d) {
                    return projection([d.geodata.longitude, d.geodata.latitude])[1] + "px";
                })
                .attr("dy", "0.35em")
                .text(function(d) { return d.title; })
        });


    });

    // console.log(linepoints);

    var line = d3.svg.line()
            .x(function(d, i) {
                // console.log("data point #" + i + ", x: " + d[0]);
                return d[0];
            })
            .y(function(d, i) {
                // console.log("data point #" + i + ", y: " + d[1]);
                return d[1];
            })
            .interpolate("linear")
    ;


    d3.select(".goodies").insert("path", ".datapoint")
        .attr("class", "weenie")
        .attr("d", line(linepoints));
}
