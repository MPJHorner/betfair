<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Betfair | Api</title>
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap/dist/css/bootstrap.min.css"/>
        <link type="text/css" rel="stylesheet" href="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.css"/>
        <link rel="stylesheet" type="text/css" href="/css/styles.css">

    </head>
    <body>

        <div id="app" v-cloak>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h4 class="text-center pt-5 pb-5">Events List</h4>
                        <p>Please notice that we are on <b>Testing</b> mode, the api provides a test demo which is very delayed, we fetch the data every <b>15</b> seconds and the data may be changed or not, so please watch the table for <b>5-15 mins</b></p>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Market Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="row in highlightedData">
                                        <td>[{ row.id }]</td>
                                        <td>[{ row.name }]</td>
                                        <td :class="row.class">[{ row.count }]</td>
                                    </tr>
                                    <tr v-if="loading">
                                        <td colspan="3" class="text-center">
                                            <img src="/spinner.gif" width="50px">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="//unpkg.com/babel-polyfill@latest/dist/polyfill.min.js"></script>
        <script src="//unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script type="text/javascript" src="/js/scripts.js"></script>
    </body>
</html>
