var myApp = angular.module('myApp', []);

myApp.controller('mainController', ['$scope', '$filter', '$http', function($scope, $filter, $http) {


    // This checks our list of transactions, and adds up the totals
    $scope.recalculate = function() {

        // Make sure we have transactions to check
        if ($scope.transactions) {

            var index;
            var total = 0;

            // Loop through the transactions
            for (index = 0; index < $scope.transactions.length; ++index) {

                // Keep track of the current transaction
                var transaction = $scope.transactions[index];

                // Debits need to subtract from the total
                if (transaction.type === 'debit') {

                    total -= parseInt(transaction.amount);

                // Credits need to add to the total
                } else if (transaction.type === 'credit') {

                    total += parseInt(transaction.amount);

                }

            }

            // Update our scope total with the new calculations
            $scope.total = total;

        }

    }

    // Pulls data from the API
    $scope.getDebts = function() {
        $http.get('get-debts')
            .success(function(result) {

                // Set the data as our new transactions
                $scope.transactions = result;

                // Recalculate the math, now that things have changed
                $scope.recalculate();

            })
            .error(function() {
                console.log('failed to load debts API');
            });


    }



    // Holds the list of all transactions
    $scope.transactions = [];

    // Holds any new transaction being added, otherwise empty
    $scope.newTransaction = {};

    $scope.getDebts();

    // Holds the total
    $scope.total = 0;




    // This adds a transaction to the list
    $scope.addTransaction = function() {

        // Check to see if we have a new transaction to add
        if ($scope.newTransaction) {

            // Save to the API
            $http.post('add-debt', $scope.newTransaction)
                .success(function(result) {

                    // Call the function to update all our debts with the new data from the DB
                    $scope.getDebts();

                })
                .error(function() {
                    console.log('failed to load debts API');
                });

        }

    };


    // This removes a transaction from the list
    $scope.removeTransaction = function(transaction) {

        // Check that we have the transaction to remove
        if (transaction) {

            var id = transaction.id;

            // Call the API
            $http.post('remove-debt', id)
                .success(function(result) {

                    // Call the function to update all our debts with the new data from the DB
                    $scope.getDebts();

                })
                .error(function() {
                    console.log('failed to load debts API');
                });

        }

    };


}]);