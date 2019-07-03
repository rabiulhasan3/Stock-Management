 <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
        <div>
          <p class="app-sidebar__user-name">{{ Auth::user()->name }}</p>
          <p class="app-sidebar__user-designation">{{ Auth::user()->email }}</p>
        </div>
      </div>
      <ul class="app-menu">

        <li><a class="app-menu__item {{ Request::is('home*')? 'active' : ''}}" href="{{ route('home') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        <li>
          
           <li>
          <a class="app-menu__item {{ Request::is('stock*')? 'active' : ''}}" href="{{ route('stock.index') }}"><i class="app-menu__icon fa fa-database" aria-hidden="true"></i><span class="app-menu__label">Stock</span>
          </a>
        </li>

          <a class="app-menu__item {{ Request::is('category*')? 'active' : ''}}" href="{{ route('category.index') }}"><i class="app-menu__icon fa fa-tasks" aria-hidden="true"></i><span class="app-menu__label">Category</span>
          </a>
        </li>

        <li>
          <a class="app-menu__item {{ Request::is('subcategory*')? 'active' : ''}}" href="{{ route('subcategory.index') }}"><i class="app-menu__icon fa fa-snowflake-o" aria-hidden="true"></i><span class="app-menu__label">Subcategory</span>
          </a>
        </li>

        <li>
          <a class="app-menu__item {{ Request::is('brand*')? 'active' : ''}}" href="{{ route('brand.index') }}"><i class="app-menu__icon fa fa-bandcamp" aria-hidden="true"></i><span class="app-menu__label">Brand</span>
          </a>
        </li>

        

         <li>
          <a class="app-menu__item {{ Request::is('supplier*')? 'active' : ''}}" href="{{ route('supplier.index') }}"><i class="app-menu__icon fa fa-truck" aria-hidden="true"></i><span class="app-menu__label">Supplier</span>
          </a>
        </li>

        <li>
          <a class="app-menu__item {{ Request::is('product*')? 'active' : ''}}" href="{{ route('product.index') }}"><i class="app-menu__icon fa fa-product-hunt" aria-hidden="true"></i><span class="app-menu__label">Product</span>
          </a>
        </li>

        <li>
          <a class="app-menu__item {{ Request::is('purchase*')? 'active' : ''}}" href="{{ route('purchase.index') }}"><i class="app-menu__icon fa fa-shopping-cart" aria-hidden="true"></i><span class="app-menu__label">Purchase</span>
          </a>
        </li>

         <li>
          <a class="app-menu__item {{ Request::is('sales*')? 'active' : ''}}" href="{{ route('sales.index') }}"><i class="app-menu__icon fa fa-shopping-bag" aria-hidden="true"></i><span class="app-menu__label">Sales</span>
          </a>
        </li>



         <li>
          <a class="app-menu__item {{ Request::is('customer*')? 'active' : ''}}" href="{{ route('customer.index') }}"><i class="app-menu__icon fa fa-users" aria-hidden="true"></i><span class="app-menu__label">Customer</span>
          </a>
        </li>

        

         <li>
          <a class="app-menu__item {{ Request::is('report*')? 'active' : ''}}" href="{{ route('report.index') }}"><i class="app-menu__icon fa fa-book" aria-hidden="true"></i><span class="app-menu__label">Report</span>
          </a>
        </li>
        
        
      </ul>
    </aside>