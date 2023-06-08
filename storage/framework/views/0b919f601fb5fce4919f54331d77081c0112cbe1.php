<div class="navbar-expand-xl">
    <div class="collapse navbar-collapse" id="navbar-menu">
      <div class="navbar navbar-light">
        <div class="container-xl">
          <ul class="navbar-nav">
            <li class="nav-item <?php echo e(request()->routeIs('user.dashboard') ? 'active' : ''); ?>">
              <a class="nav-link" href="<?php echo e(route('user.dashboard')); ?>">
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                </span>
                <span class="nav-link-title">
                  <?php echo app('translator')->get('Home'); ?>
                </span>
              </a>
            </li>

            <?php
              $modules = explode(" , ", $gs->user_module);
            ?>

            <?php if(!in_array('Loan',$modules)): ?>
              <li class="nav-item dropdown <?php echo e(request()->routeIs('user.loans.plan') || request()->routeIs('user.loans.index') || request()->routeIs('user.loans.pending') || request()->routeIs('user.loans.paid') || request()->routeIs('user.loans.rejected') ? 'active' : ''); ?>">
                <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <i class="fas fa-cash-register"></i>
                  </span>
                  <span class="nav-link-title">
                    <?php echo e(__('Loan')); ?>

                  </span>
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="<?php echo e(route('user.loans.plan')); ?>" >
                    <?php echo e(__('Loan Plan')); ?>

                  </a>

                  <a class="dropdown-item" href="<?php echo e(route('user.loans.index')); ?>" >
                    <?php echo e(__('All Loans')); ?>

                  </a>

                  <a class="dropdown-item" href="<?php echo e(route('user.loans.pending')); ?>" >
                    <?php echo e(__('Pending Loans')); ?>

                  </a>

                  <a class="dropdown-item" href="<?php echo e(route('user.loans.running')); ?>" >
                    <?php echo e(__('Running Loans')); ?>

                  </a>

                  <a class="dropdown-item" href="<?php echo e(route('user.loans.paid')); ?>" >
                    <?php echo e(__('Paid Loans')); ?>

                  </a>

                  <a class="dropdown-item" href="<?php echo e(route('user.loans.rejected')); ?>" >
                    <?php echo e(__('Rejected Loans')); ?>

                  </a>
                </div>
              </li>
            <?php endif; ?>

            <?php if(!in_array('DPS',$modules)): ?>
              <li class="nav-item dropdown <?php echo e(request()->routeIs('user.dps.plan') || request()->routeIs('user.dps.index') || request()->routeIs('user.dps.running') || request()->routeIs('user.dps.matured') ? 'active' : ''); ?>">
                <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <i class="fas fa-warehouse"></i>
                  </span>
                  <span class="nav-link-title">
                    <?php echo e(__('DPS')); ?>

                  </span>
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="<?php echo e(route('user.dps.plan')); ?>" >
                    <?php echo e(__('Dps Plan')); ?>

                  </a>

                  <a class="dropdown-item" href="<?php echo e(route('user.dps.index')); ?>" >
                    <?php echo e(__('All dps')); ?>

                  </a>

                  <a class="dropdown-item" href="<?php echo e(route('user.dps.running')); ?>" >
                    <?php echo e(__('Running dps')); ?>

                  </a>

                  <a class="dropdown-item" href="<?php echo e(route('user.dps.matured')); ?>" >
                    <?php echo e(__('Matured dps')); ?>

                  </a>

                </div>
              </li>
            <?php endif; ?>

            <?php if(!in_array('FDR',$modules)): ?>
              <li class="nav-item dropdown <?php echo e(request()->routeIs('user.fdr.plan') || request()->routeIs('user.fdr.index') || request()->routeIs('user.fdr.running') || request()->routeIs('user.fdr.closed') ? 'active' : ''); ?>">
                <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <i class="fas fa-user-shield"></i>
                  </span>
                  <span class="nav-link-title">
                    <?php echo e(__('FDR')); ?>

                  </span>
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="<?php echo e(route('user.fdr.plan')); ?>" >
                    <?php echo e(__('Fdr Plan')); ?>

                  </a>

                  <a class="dropdown-item" href="<?php echo e(route('user.fdr.index')); ?>" >
                    <?php echo e(__('All Fdr')); ?>

                  </a>

                  <a class="dropdown-item" href="<?php echo e(route('user.fdr.running')); ?>" >
                    <?php echo e(__('Running Fdr')); ?>

                  </a>

                  <a class="dropdown-item" href="<?php echo e(route('user.fdr.closed')); ?>" >
                    <?php echo e(__('Closed Fdr')); ?>

                  </a>
                </div>
              </li>
            <?php endif; ?>

            <?php if(!in_array('Request Money',$modules)): ?>
              <li class="nav-item dropdown <?php echo e(request()->routeIs('user.money.request.index') || request()->routeIs('user.request.money.receive') ? 'active' : ''); ?>">
                <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <i class="fas fa-file-signature"></i>
                  </span>
                  <span class="nav-link-title">
                    <?php echo e(__('Request Money')); ?>

                  </span>
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="<?php echo e(route('user.money.request.index')); ?>" >
                    <?php echo e(__('Send Request Money')); ?>

                  </a>

                  <a class="dropdown-item" href="<?php echo e(route('user.request.money.receive')); ?>" >
                    <?php echo e(__('Receive Request Money')); ?>

                  </a>
                </div>
              </li>
            <?php endif; ?>

            <?php if(!in_array('Deposit',$modules)): ?>
              <li class="nav-item <?php echo e(request()->routeIs('user.deposit.index') ? 'active' : ''); ?>">
                  <a class="nav-link" href="<?php echo e(route('user.deposit.index')); ?>" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <i class="fas fa-hand-holding-usd"></i>
                    </span>
                    <span class="nav-link-title">
                      <?php echo e(__('Deposit')); ?>

                    </span>
                  </a>
              </li>
            <?php endif; ?>

            <?php if(!in_array('Wire Transfer',$modules)): ?>
              <li class="nav-item <?php echo e(request()->routeIs('user.wire.transfer.index') ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('user.wire.transfer.index')); ?>" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <i class="fas fa-tram"></i>
                  </span>
                  <span class="nav-link-title">
                    <?php echo e(__('Wire Transfer')); ?>

                  </span>
                </a>
              </li>
            <?php endif; ?>

            <?php if(!in_array('Transfer',$modules)): ?>
              <li class="nav-item dropdown <?php echo e(request()->routeIs('send.money.create') || request()->routeIs('user.beneficiaries.index') || request()->routeIs('user.other.bank') || request()->routeIs('tranfer.logs.index') ? 'active' : ''); ?>">
                <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <i class="fas fa-exchange-alt"></i>
                  </span>
                  <span class="nav-link-title">
                    <?php echo e(__('Transfer')); ?>

                  </span>
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="<?php echo e(route('send.money.create')); ?>" >
                    <?php echo e(__('Send Money')); ?>

                  </a>

                  <a class="dropdown-item" href="<?php echo e(route('user.beneficiaries.index')); ?>" >
                    <?php echo e(__('Beneficiary Manage')); ?>

                  </a>

                  <a class="dropdown-item" href="<?php echo e(route('user.other.bank')); ?>" >
                    <?php echo e(__('Other Bank Transfer')); ?>

                  </a>

                  <a class="dropdown-item" href="<?php echo e(route('tranfer.logs.index')); ?>" >
                    <?php echo e(__('Transfer History')); ?>

                  </a>
                </div>
              </li>
            <?php endif; ?>

            <?php if($gs->withdraw_status == 1): ?>
              <?php if(!in_array('Withdraw',$modules)): ?>
                <li class="nav-item <?php echo e(request()->routeIs('user.withdraw.index') ? 'active' : ''); ?>">
                  <a class="nav-link" href="<?php echo e(route('user.withdraw.index')); ?>" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <i class="fas fa-file-signature"></i>
                    </span>
                    <span class="nav-link-title">
                      <?php echo e(__('Withdraw')); ?>

                    </span>
                  </a>
                </li>
              <?php endif; ?>
            <?php endif; ?>

            <?php if(!in_array('Pricing Plan',$modules)): ?>
              <li class="nav-item <?php echo e(request()->routeIs('user.package.index') ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('user.package.index')); ?>" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <i class="fab fa-affiliatetheme"></i>
                  </span>
                  <span class="nav-link-title">
                    <?php echo e(__('Pricing Plan')); ?>

                  </span>
                </a>
              </li>
            <?php endif; ?>

            <?php if(!in_array('More',$modules)): ?>
              <li class="nav-item dropdown <?php echo e(request()->routeIs('user.show2faForm') || request()->routeIs('user.referral.index') || request()->routeIs('user.referral.commissions') || request()->routeIs('user.message.index') || request()->routeIs('user.other.bank') ? 'active' : ''); ?>">
                <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <i class="fas fa-suitcase"></i>
                  </span>
                  <span class="nav-link-title">
                    <?php echo e(__('More')); ?>

                  </span>
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="<?php echo e(route('user.show2faForm')); ?>" >
                    <?php echo e(__('2FA Security')); ?>

                  </a>

                  <a class="dropdown-item" href="<?php echo e(route('user.referral.index')); ?>" >
                    <?php echo app('translator')->get('Referred Users'); ?>
                  </a>

                  <a class="dropdown-item" href="<?php echo e(route('user.referral.commissions')); ?>" >
                    <?php echo app('translator')->get('Referral Commissions'); ?>
                  </a>

                  <a class="dropdown-item" href="<?php echo e(route('user.message.index')); ?>" >
                    <?php echo e(__('Support Tickets')); ?>

                  </a>

                  <a class="dropdown-item" href="<?php echo e(route('user.transaction')); ?>" >
                    <?php echo e(__('Transactions')); ?>

                  </a>
                </div>
              </li>
            <?php endif; ?>

          </ul>
        </div>
      </div>
    </div>
  </div><?php /**PATH /home/royalscripts/public_html/test/geniusbank/project/resources/views/includes/user/nav.blade.php ENDPATH**/ ?>