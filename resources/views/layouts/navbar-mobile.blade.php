<div class="mobile-menu">
    <nav id="dropdown">
        <ul class="mobile-menu-nav">
            <li>
                <a title="Dashboard" class="icon-wrap" href="{{ url('/') }}" aria-expanded="false">
                    <span class="fa fa-home sub-icon-mg" aria-hidden="true"></span>
                    <span class="mini-click-non ">Dashboard</span>
                </a>
            </li>
            <li>
                <a class="has-arrow" title="Data Pembayaran" href="#" aria-expanded="false">
                    <span class="fa fa-credit-card sub-icon-mg" aria-hidden="true"></span>
                    <span class="mini-click-non ">Pembayaran</span>
                </a>
                <ul class="submenu-angle" aria-expanded="false">
                    <li><a title="Pembayaran SPP" href="{{ route('spp.index') }}"><span class="mini-sub-pro">SPP</span></a></li>
                    <li><a title="Pembayaran Lain - Lain" href="{{ route('payment.index') }}"><span class="mini-sub-pro">Lain-Lain</span></a>
                    </li>
                </ul>
            </li>
            <li>
                <a title="Data Pemasukan" class="" href="{{ route('income.index') }}" aria-expanded="false">
                    <span class="educate-icon educate-department sub-icon-mg" aria-hidden="true"></span>
                    <span class="mini-click-non ">Pemasukan</span>
                </a>
            </li>
            <li>
                <a title="Data Pengeluaran" class="" href="{{ route('expense.index') }}" aria-expanded="false">
                    <span class="fa fa-tags sub-icon-mg" aria-hidden="true"></span>
                    <span class="mini-click-non ">Pengeluaran</span>
                </a>
            </li>
            <li>
                <a title="Rekapitulasi" class="" href="{{ route('rekap.index') }}" aria-expanded="false">
                    <span class="fa fa-files-o sub-icon-mg" aria-hidden="true"></span>
                    <span class="mini-click-non ">Rekap</span>
                </a>
            </li>
            <li>
                <a class="has-arrow" title="Data Master" href="#" aria-expanded="false">
                    <span class="fa fa-diamond sub-icon-mg" aria-hidden="true"></span>
                    <span class="mini-click-non ">Master</span>
                </a>
                <ul class="submenu-angle" aria-expanded="false">
                    <li><a title="Data Master Siswa" href="{{ route('students.index') }}"><span class="mini-sub-pro">Siswa</span></a></li>
                    <li><a title="Data Master Jurusan" href="{{ route('majors.index') }}"><span class="mini-sub-pro">Jurusan</span></a>
                    </li>
                    <li><a title="Data Master Kategori Pembiayaan" href="{{ url('financing') }}"><span class="mini-sub-pro">Kategori Pembiayaan</span></a></li>
                    <li><a title="User Managemet" href="{{ route('user.index') }}"><span class="mini-sub-pro">User Management</span></a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</div>
