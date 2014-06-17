// add any scripting here

var parchment, ww, wh, projection;

$(document).ready(function() {
    parchment = d3.select(".parchment");

    loadjson();
});




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
    ww = $(window).width(), wh = $(window).height();

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

    mapstuff.selectAll(".subunit")
        .data(topojson.feature(nipple, nipple.objects.subunits).features)
        .enter().append("path")
        .attr("class", function(d) { return "subunit " + d.id; })
        .attr("d", path)
    ;

    pullposts(nipple);

}


function booty(thang, junk) {
    console.log(thang);

    dots = parchment.append("g").attr("class", "goodies");

    _(thang.posts).each(function(ell, ix) {
        console.log(ell);
        dots.selectAll("circle")
            .data(thang.posts)
            .enter().append("circle")
            .attr("class", "dot")
            .attr("id", function(d) { return d.name; })
            .attr("r", "10px")
            .attr("transform", function(d) {
                return "translate(" + projection([d.geodata.longitude, d.geodata.latitude]) + ")";
            })
        ;

    });
}
