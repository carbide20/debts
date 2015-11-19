<html ng-app="myApp">
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular-messages.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular-resource.min.js"></script>

        <!-- Bootstrap -->
        <link href="../resources/assets/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">

    </head>
    <body>

        <div ng-controller="mainController">

            <form class="form-horizontal" ng-submit="addTransaction()">
                <fieldset>

                    <!-- Form Name -->
                    <legend>Add Transaction</legend>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="name">Name</label>
                        <div class="col-md-4">
                            <input id="name" name="name" type="text" placeholder="Person/Company" class="form-control input-md" required="" ng-model="newTransaction.name">
                            <span class="help-block">help</span>
                        </div>
                    </div>

                    <!-- Textarea -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="description">Description</label>
                        <div class="col-md-4">
                            <textarea class="form-control" id="description" name="description" ng-model="newTransaction.description">Description of the transaction</textarea>
                        </div>
                    </div>

                    <!-- Select Basic -->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="type">Type</label>
                        <div class="col-md-4">
                            <select id="type" name="type" class="form-control" ng-model="newTransaction.type">
                                <option value="debit">debit</option>
                                <option value="credit">credit</option>
                            </select>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="amount">Amount</label>
                        <div class="col-md-2">
                            <input id="amount" name="amount" type="text" placeholder="$" class="form-control input-md" required="" ng-model="newTransaction.amount">
                            <span class="help-block">help</span>
                        </div>
                    </div>

                    <input type="submit" value="Add" name="submit" />

                </fieldset>
            </form>

            <table border="1" class="table table-bordered">
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
                <tr ng-repeat="transaction in transactions" ng-class="{'alert-danger': transaction.type == 'debit', 'alert-success': transaction.type == 'credit'}">
                    <td>{{transaction.name}}</td>
                    <td>{{transaction.description}}</td>
                    <td>{{transaction.type}}</td>
                    <td>{{transaction.amount}}</td>
                    <td><button ng-click="removeTransaction(transaction)">Remove</button></td>
                </tr>
            </table>
            <div class="alert" ng-class="{'alert-danger': total < 0, 'alert-success': total > 0, 'alert-info': total === 0}">{{total}}</div>


        </div>


        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="../resources/assets/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
        <script src="../resources/assets/app.js"></script>


    </body>
</html>