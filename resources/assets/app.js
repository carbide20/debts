var myApp = angular.module('myApp', []);

myApp.controller('mainController', ['$scope', '$filter', function($scope, $filter) {

    // Holds the list of all transactions
    $scope.transactions = [];

    // Holds any new transaction being added, otherwise empty
    $scope.newTransaction = {};

    // Holds the total
    $scope.total = 0;

    // This is tied to the add transaction form
    $scope.addTransaction = function() {

        // Check to see if we have a new transaction to add
        if ($scope.newTransaction) {

            // Push the new transaction to the list
            $scope.transactions.push($scope.newTransaction);

            // Reset
            $scope.newTransaction = {};

            // Recalculate our math, now that things have changed
            $scope.recalculate();

        }

    };

    $scope.removeTransaction = function(transaction) {

        // Check that we have the transaction to remove
        if (transaction) {

            // Remove the transaction from the array
            $scope.transactions.splice($scope.transactions.indexOf(transaction), 1);

            // Recalculate the math, now that things have changed
            $scope.recalculate();

        }

    };

    $scope.recalculate = function() {

        if ($scope.transactions) {

            var index;
            var total = 0;

            for (index = 0; index < $scope.transactions.length; ++index) {

                var item = $scope.transactions[index];

                if (item.type === 'debit') {

                    total -= parseInt(item.amount);
                    console.log('subtracted ' + item.amount + ' from total');

                } else if (item.type === 'credit') {

                    total += parseInt(item.amount);
                    console.log('added ' + item.amount + ' to total');

                }

            }

            $scope.total = total;

        }

    }



}]);