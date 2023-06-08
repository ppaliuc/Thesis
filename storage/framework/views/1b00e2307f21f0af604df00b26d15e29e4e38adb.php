  <li class="nav-item">
    <a class="nav-link" href="<?php echo e(route('admin.gs.menubuilder')); ?>">
      <i class="fas fa-compass"></i>
      <span><?php echo e(__('Menu Builder')); ?></span></a>
  </li>


  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#customer" aria-expanded="true"
      aria-controls="collapseTable">
      <i class="fas fa-user"></i>
      <span><?php echo e(__('Manage Customers')); ?></span>
    </a>
    <div id="customer" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?php echo e(route('admin.user.index')); ?>"><?php echo e(__('User List')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.bank.plan.index')); ?>"><?php echo e(__('Bank Plans')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.kyc.info','user')); ?>"><?php echo e(__('User KYC Info')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.manage.module')); ?>"><?php echo e(__('User KYC Modules')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.withdraw.index')); ?>"><?php echo e(__('Withdraw Request')); ?> <?php if( DB::table('withdraws')->where('status','pending')->count() > 0): ?>
        <span class="badge badge-sm badge-danger badge-counter"><?php echo e(DB::table('withdraws')->where('status','pending')->count()); ?></span><?php endif; ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin-withdraw-method-index')); ?>"><?php echo e(__('WithDraw Method')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.user.bonus')); ?>"><?php echo e(__('Refferel Bonus')); ?></a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#loan" aria-expanded="true" aria-controls="collapseTable">
      <i class="fas fa-cash-register"></i>
    <span><?php echo e(__('Loan Management')); ?></span>
  </a>
    <div id="loan" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?php echo e(route('admin.loan.plan.index')); ?>"><?php echo e(__('Loan Plans')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.loan.index')); ?>"><?php echo e(__('All Loans')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.loan.pending')); ?>"><?php echo e(__('Pending Loan')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.loan.running')); ?>"><?php echo e(__('Running Loan')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.loan.completed')); ?>"><?php echo e(__('Paid Loan')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.loan.rejected')); ?>"><?php echo e(__('Rejected Loan')); ?></a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dps" aria-expanded="true" aria-controls="collapseTable">
      <i class="fas fa-warehouse"></i>
    <span><?php echo e(__('DPS Management')); ?></span>
  </a>
    <div id="dps" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?php echo e(route('admin.dps.plan.index')); ?>"><?php echo e(__('Dps Plans')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.dps.index')); ?>"><?php echo e(__('All Dps')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.dps.running')); ?>"><?php echo e(__('Running Dps')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.dps.matured')); ?>"><?php echo e(__('Matured Dps')); ?></a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#fdr" aria-expanded="true" aria-controls="collapseTable">
      <i class="fas fa-user-shield"></i>
    <span><?php echo e(__('FDR Management')); ?></span>
  </a>
    <div id="fdr" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?php echo e(route('admin.fdr.plan.index')); ?>"><?php echo e(__('Fdr Plans')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.fdr.index')); ?>"><?php echo e(__('All Fdr')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.fdr.running')); ?>"><?php echo e(__('Running Fdr')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.fdr.closed')); ?>"><?php echo e(__('Closed Fdr')); ?></a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="<?php echo e(route('admin.other.banks.index')); ?>">
      <i class="fas fa-landmark"></i>
      <span><?php echo e(__('Other Banks')); ?></span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#moneytransfer" aria-expanded="true" aria-controls="collapseTable">
      <i class="fas fa-exchange-alt"></i>
    <span><?php echo e(__('Money Transfer')); ?></span>
  </a>
    <div id="moneytransfer" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?php echo e(route('admin.own.banks.transfer.index')); ?>"><?php echo e(__('Own Bank Transfer')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.other.banks.transfer.index')); ?>"><?php echo e(__('Other Bank Transfer')); ?></a>
      </div>
    </div>
  </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#wiretransfer" aria-expanded="true" aria-controls="collapseTable">
            <i class="fas fa-wallet"></i>
            <span><?php echo e(__('Wire Transfer')); ?></span>
        </a>
        <div id="wiretransfer" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?php echo e(route('admin.wire.transfer.banks.index')); ?>"><?php echo e(__('Wire Transfer Bank')); ?></a>
                <a class="collapse-item" href="<?php echo e(route('admin.wire.transfer.index')); ?>"><?php echo e(__('Wire Transfers')); ?></a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#requestmoney" aria-expanded="true" aria-controls="collapseTable">
            <i class="fas fa-donate"></i>
            <span><?php echo e(__('Request Money')); ?></span>
        </a>
        <div id="requestmoney" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?php echo e(route('admin.request.money')); ?>"><?php echo e(__('All Money Request')); ?></a>
                <a class="collapse-item" href="<?php echo e(route('admin.request.setting.create')); ?>"><?php echo e(__('Money Request Setting')); ?></a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="<?php echo e(route('admin.transactions.index')); ?>">
            <i class="fas fa-chart-line"></i>
            <span><?php echo e(__('Transactions')); ?></span>
        </a>
    </li>

  <li class="nav-item">
    <a class="nav-link" href="<?php echo e(route('admin.deposits.index')); ?>">
      <i class="fas fa-piggy-bank"></i>
      <span><?php echo e(__('Deposits')); ?></span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#blog" aria-expanded="true"
      aria-controls="collapseTable">
      <i class="fas fa-fw fa-newspaper"></i>
      <span><?php echo e(__('Manage Blog')); ?></span>
    </a>
    <div id="blog" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?php echo e(route('admin.cblog.index')); ?>"><?php echo e(__('Categories')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.blog.index')); ?>"><?php echo e(__('Posts')); ?></a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable1" aria-expanded="true"
      aria-controls="collapseTable">
      <i class="fas fa-fw fa-cogs"></i>
      <span><?php echo e(__('General Settings')); ?></span>
    </a>
    <div id="collapseTable1" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?php echo e(route('admin.gs.logo')); ?>"><?php echo e(__('Logo')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.gs.fav')); ?>"><?php echo e(__('Favicon')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.gs.load')); ?>"><?php echo e(__('Loader')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.gs.breadcumb')); ?>"><?php echo e(__('Breadcumb Banner')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.gs.contents')); ?>"><?php echo e(__('Website Contents')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.gs.cookie')); ?>"><?php echo e(__('Cookie Concent')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.gs.customcss')); ?>"><?php echo e(__('Custom css')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.gs.user.modules')); ?>"><?php echo e(__('User Modules')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.gs.error.banner')); ?>"><?php echo e(__('Error Banner')); ?></a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#homepage" aria-expanded="true"
    aria-controls="collapseTable">
    <i class="fas fa-igloo"></i>
    <span><?php echo e(__('Home Page Manage')); ?></span>
  </a>
    <div id="homepage" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?php echo e(route('admin.ps.hero')); ?>"><?php echo e(__('Hero Section')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.feature.index')); ?>"><?php echo e(__('Feature Section')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.ps.about')); ?>"><?php echo e(__('About Us Section')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.service.index')); ?>"><?php echo e(__('Service Section')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.account.process.index')); ?>"><?php echo e(__('Account Register Process')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.ps.account')); ?>"><?php echo e(__('Strategy Section')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.ps.apps')); ?>"><?php echo e(__('Apps Section')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.review.index')); ?>"><?php echo e(__('Testimonial Section')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.counter.index')); ?>"><?php echo e(__('Counter Section')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.ps.quick')); ?>"><?php echo e(__('Quick Start Section')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.ps.heading')); ?>"><?php echo e(__('Section Heading')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.ps.customization')); ?>"><?php echo e(__('Homepage Customization')); ?></a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#email_settings" aria-expanded="true"
      aria-controls="collapseTable">
      <i class="fa fa-envelope"></i>
      <span><?php echo e(__('Email Settings')); ?></span>
    </a>
    <div id="email_settings" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?php echo e(route('admin.mail.index')); ?>"><?php echo e(__('Email Template')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.mail.config')); ?>"><?php echo e(__('Email Configurations')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.group.show')); ?>"><?php echo e(__('Group Email')); ?></a>
      </div>
    </div>
  </li>


  <li class="nav-item">
    <a class="nav-link" href="<?php echo e(route('admin.user.message')); ?>">
      <i class="fas fa-vote-yea"></i>
      <span><?php echo e(__('Messages')); ?></span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#payment_gateways" aria-expanded="true"
      aria-controls="collapseTable">
      <i class="fas fa-fw fa-newspaper"></i>
      <span><?php echo e(__('Payment Settings')); ?></span>
    </a>
    <div id="payment_gateways" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?php echo e(route('admin.currency.index')); ?>"><?php echo e(__('Currencies')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.payment.index')); ?>"><?php echo e(__('Payment Gateways')); ?></a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="<?php echo e(route('admin.role.index')); ?>">
      <i class="fa fa-crop"></i>
      <span><?php echo e(__('Manage Roles')); ?></span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="<?php echo e(route('admin.staff.index')); ?>">
      <i class="fas fa-fw fa-users"></i>
      <span><?php echo e(__('Manage Staff')); ?></span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="<?php echo e(route('admin.manage.kyc.user','user')); ?>">
      <i class="fas fa-child"></i>
      <span><?php echo e(__('Manage KYC Form')); ?></span></a>
  </li>


  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#langs" aria-expanded="true"
      aria-controls="collapseTable">
      <i class="fas fa-language"></i>
      <span><?php echo e(__('Language Manage')); ?></span>
    </a>
    <div id="langs" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?php echo e(route('admin.lang.index')); ?>"><?php echo e(__('Website Language')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.tlang.index')); ?>"><?php echo e(__('Admin Panel Language')); ?></a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="<?php echo e(route('admin.font.index')); ?>">
      <i class="fas fa-font"></i>
      <span><?php echo e(__('Fonts')); ?></span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menu" aria-expanded="true"
      aria-controls="collapseTable">
      <i class="fas fa-fw fa-edit"></i>
      <span><?php echo e(__('Menu Page Settings')); ?></span>
    </a>
    <div id="menu" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?php echo e(route('admin.ps.contact')); ?>"><?php echo e(__('Contact Us Page')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.page.index')); ?>"><?php echo e(__('Other Pages')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.faq.index')); ?>"><?php echo e(__('FAQ Page')); ?></a>
      </div>
    </div>
  </li>


  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#seoTools" aria-expanded="true"
      aria-controls="collapseTable">
      <i class="fas fa-wrench"></i>
      <span><?php echo e(__('SEO Tools')); ?></span>
    </a>
    <div id="seoTools" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?php echo e(route('admin.seotool.analytics')); ?>"><?php echo e(__('Google Analytics')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.seotool.keywords')); ?>"><?php echo e(__('Website Meta Keywords')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin.social.index')); ?>"><?php echo e(__('Social Links')); ?></a>
      </div>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="<?php echo e(route('admin.sitemap.index')); ?>">
      <i class="fa fa-sitemap"></i>
      <span><?php echo e(__('Sitemaps')); ?></span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="<?php echo e(route('admin.subs.index')); ?>">
      <i class="fas fa-fw fa-users-cog"></i>
      <span><?php echo e(__('Subscribers')); ?></span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="<?php echo e(route('admin.cache.clear')); ?>">
      <i class="fas fa-sync"></i>
      <span><?php echo e(__('Clear Cache')); ?></span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#sactive" aria-expanded="true"
      aria-controls="collapseTable">
      <i class="fas fa-fw fa-at"></i>
      <span><?php echo e(__('System Activation')); ?></span>
    </a>
    <div id="sactive" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?php echo e(route('admin-activation-form')); ?>"><?php echo e(__('Activation')); ?></a>
        <a class="collapse-item" href="<?php echo e(route('admin-generate-backup')); ?>"><?php echo e(__('Generate Backup')); ?></a>
      </div>
    </div>
  </li>


<?php /**PATH C:\mamp\htdocs\geniusbank\project\resources\views/includes/admin/roles/super.blade.php ENDPATH**/ ?>