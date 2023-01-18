//----------- typeahead

var suggestions = function ($url) {
    return function findMatches(q, syncResults, asyncResults)
    {
        //var matches=[{'title':'test'}];
        //cb(matches);
        var $url_q=$url.replace('%QUERY%',q);
        //console.log(url_q);
        axios.get($url_q).then(
            function (response) {
                console.log(response);
                asyncResults(response.data.data);
            }
        ).catch(
            function (error) {
                console.log(error);
            }
        ).finally(
            function () {
            }
        );
    };
};


$(".typeahead").each(
    function () {
        var $this=$(this);
        var $name=$this.data('name');
        $this.input=$this.closest("div").find("input[name="+$name+"]");
        $this.on(
            'keyup',function (e) {
                $this.input.val(''); //se digito svuoto
            }
        );
        $this.bind(
            'typeahead:select', function (ev, suggestion) {
                var $val=suggestion['id'];
                $this.input.val($val);
            }
        );
        $this.typeahead(
            {  
                hint: true,
                highlight: true, // Enable substring highlighting 
                minLength: 3, // Specify minimum characters required for showing suggestions 
            },{
                name: $this.data('name'),
                displayKey:'label',//senza questo mi mostra il json
                source: suggestions($this.data('url')), 
                templates: {
                    pending :[
                    '<div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status"><span class="sr-only">Loading...</span></div>'
                    ],
                    empty: [
                    '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                    ],
                    header: [
                    '<div class="list-group search-results-dropdown">'
                    ],
                    suggestion: function (data) {
                         return '<a href="#" class="list-group-item">'+data.label+'</a>'
                    }
                }
            }
        );
    }
);   
