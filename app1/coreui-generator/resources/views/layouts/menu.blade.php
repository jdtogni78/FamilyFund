<li class="nav-item {{ Request::is('funds*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('funds.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Funds</span>
    </a>
</li>
<li class="nav-item {{ Request::is('accountBalances*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('accountBalances.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Account Balances</span>
    </a>
</li>
<li class="nav-item {{ Request::is('accountMatchingRules*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('accountMatchingRules.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Account Matching Rules</span>
    </a>
</li>
<li class="nav-item {{ Request::is('accountTradingRules*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('accountTradingRules.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Account Trading Rules</span>
    </a>
</li>
<li class="nav-item {{ Request::is('accounts*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('accounts.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Accounts</span>
    </a>
</li>
<li class="nav-item {{ Request::is('assetPrices*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('assetPrices.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Asset Prices</span>
    </a>
</li>
<li class="nav-item {{ Request::is('assets*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('assets.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Assets</span>
    </a>
</li>
<li class="nav-item {{ Request::is('matchingRules*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('matchingRules.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Matching Rules</span>
    </a>
</li>
<li class="nav-item {{ Request::is('portfolioAssets*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('portfolioAssets.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Portfolio Assets</span>
    </a>
</li>
<li class="nav-item {{ Request::is('portfolios*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('portfolios.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Portfolios</span>
    </a>
</li>
<li class="nav-item {{ Request::is('tradingRules*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('tradingRules.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Trading Rules</span>
    </a>
</li>
<li class="nav-item {{ Request::is('transactions*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('transactions.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Transactions</span>
    </a>
</li>
<li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('users.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Users</span>
    </a>
</li>
<li class="nav-item {{ Request::is('samples*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('samples.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Samples</span>
    </a>
</li>
<li class="nav-item {{ Request::is('assetChangeLogs*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('assetChangeLogs.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Asset Change Logs</span>
    </a>
</li>
