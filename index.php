<!DOCTYPE html>
<html>
<head>
    <title>Hashr</title>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/element-ui/lib/index.js"></script>
    <script src="https://unpkg.com/element-ui/lib/umd/locale/en.js"></script>
    <script src="https://unpkg.com/vue-data-tables@2.1.0/dist/data-tables.min.js"></script>
    <link href="style.css" rel="stylesheet">
</head>
<body>
<div id="hashr">
<pre id="hashr-logo">
    __               __
   / /_  ____ ______/ /_  _____
  / __ \/ __ `/ ___/ __ \/ ___/
 / / / / /_/ (__  ) / / / /
/_/ /_/\__,_/____/_/ /_/_/ Password hash generator
</pre>
    <input type="input" v-model="query" id="hashInput" placeholder="Type here...">
    <data-tables
            :data="results"
            :show-action-bar="false"
            :pagination-def="paginationDef"
            :table-props="tableProps"
    >
        <el-table-column
                v-for="title in titles"
                :prop="title.prop"
                :label="title.label"
                :key="title.label"
                :width="title.width"
                sortable="custom">
        </el-table-column>
    </data-tables>
</div>

<script>
  // We loaded element-ui library in the header, now we set the language
  ELEMENT.locale(ELEMENT.lang.en)
  // And next we tell our Vue to use component DataTables loaded in the header
  Vue.use(DataTables)

  // These titles are to help our table component to target the right data.
  // We are looping these in el-table-column component, with our vars as "props",
  // the ones with colon before the key.
  var titles = [
    {prop: "algorithm", label: "Algorithm", 'width': 150},
    {prop: "time", label: "Hash speed (ms)", 'width': 200},
    {prop: "hash", label: "Hashed string", 'width': false}
  ];
  new Vue({
    // Element we are binding our Vue instance to
    el: "#hashr",
    // The data object is our
    data: {
      // This contains our query string
      query: '',
      // These are our titles/thead for the table
      titles,
      // This contains our hashing data, loaded with axios
      results: [],
      // These tableProps lets us define default sorting.
      // We sort the table live from values in the time column descending.
      tableProps: {
        defaultSort: {
          prop: 'time',
          order: 'descending'
        }
      },
      // These next ones are just to modify our table to look bit nicer
      paginationDef: {layout: '', pageSize: 10000, pageSizes: [10000]},
      searchDef: {show: false}
    },
    watch: {
      /**
       * We are watching our 'query' string (as in data.query)
       * for changes and when Vue detects a change, it passes the new value
       * as the first param (hash) to the function we have set up.
       * @param hash
       */
      'query': function (hash) {
        // We alias 'this', since in .then() block 'this' has changed meaning
        var vm = this;
        axios.get('hasher.php?hash=' + hash) // We do an ajax call with our hash parameter
          .then(function (response) { // When we get the response back, we run the following
            // Collect our results to a 'result' array
            var result = [];

            // This is a ES5 compatible object looping.
            // Objects do not have a forEach method themselves, which is weird,
            // but when looping the objects keys, we can then access the object
            // elements with response.data[k]. Neat, huh?
            Object.keys(response.data).forEach(function (k) {
              result.push(response.data[k]); // We collect our results
            });

            // And finally replace our 'data.results' array with new values.
            // If not done this way, the DataTable would flicker when new values
            // get set inside the loop, and more importantly, this way we
            // clear all the old results from the listing.
            vm.results = result;
          })
          .catch(function (error) { // If we somehow get an error, this will catch it.
            alert(error); // ...and display a nice alert dialog with the whole payload. YOLO.
          });
      }
    }
  });
</script>
</body>
</html>