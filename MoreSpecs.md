## OUT OF SCOPE

### V2

#### Funds (Updates)
* Has matching rules
* It can calculate the unallocated funds (that don’t belong to Fund Holders)

#### Matching Rules
* What: Rules that represent an incentive to share holders, additional shares to be added to fund share holders that purchase shares within a year.
* Input: manual
* Fields: Has Name, $ range, date period, restriction period, match(%)
* Restriction period: if balance of sales or borrows is negative within this period, reduce from matching amount
* Matching rules are global, independent of funds and portfolios

#### Share Holders
* Input: manual
* Name, email, type (person/reserve)
* CC email list (comma separated text, optional)

#### Share Holders Balance
* Input: only through fund transactions
* What: Represent how many shares each account holder owns and borrowed.
* Fields: Has Fund Holder, share type (own, borrowed), Fund id, amount of shares (double), last update

#### Fund Trading Rules
* Determine sale restrictions, further amounts must be borrowed
* Sales can only apply to the amount the fund grew last year
* Per year, sale restrictions are any combination of:
    * max sale % of increase - cant sell more than % of last year performance growth
    * min fund performance % - restrict (growth - min fund perf)

### V3
#### Infrastructure
* SMS Setup
* PDF Generation

#### Fund Holder Quarterly Report
* Report will be triggered by API
* Output is an email with an attached PDF
* PDF Content
    * Matching rule status (if borrowing or sales last year, shows as on not available)
    * Borrowing status
    * Sale Restriction % 
    * Overall Fund Performance (includes line graph)
    * Last Year Fund Performance
    * Total shares/value

#### Fund Share Transactions
* What: Represent each change in fund shares
* Input: API for adding transactions, which updates fund shares balance
* Fields: Has Share Holder, share type (purchase, sale, borrow, repay), Fund id, amount of shares (double), date
* Generates email with the change details
* Purchases
    * Apply the matching rules - validate qualification, add extra shares
        * Matching is reduced by last years sales/borrowing amount
    * Shares will be moved from the unallocated pool
    * There must be enough unallocated shares on the fund
* Sales
    * Restricted by the Fund (max %)
* Borrowing
 * Reduce Fund Holder shares, add borrowing shares

### V4

* API Should be documented with Swagger
* Documentation with JavaDoc for Java (https://dzone.com/articles/best-practices-of-code-documentation-in-java) or similar (Doxygen?) for PHP.

#### API ACL
* What: controls access to API
* Data Input: Manual
* Fields: Has roles, permissions (read/write), api/page/command line flag, URI 
* Roles: admin, price update, account holder

#### Login/Logout
* Login/Logout pages
* Security via tokens (TBD)

#### Portfolio Updates
* What: Change asset allocations and propagate to automated investment tool
* TBD

