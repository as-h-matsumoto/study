
<div id="calendar" class="page-layout simple full-width mt-0">

    <!-- HEADER -->
    <div class="page-header bg-secondary text-auto p-6">

        <!-- HEADER CONTENT-->
        <div class="header-content d-flex flex-column justify-content-between">

            <!-- HEADER TOP -->
            <div
                class="header-top row no-gutters align-items-center  justify-content-center justify-content-sm-between">

                <div class="logo row align-items-center no-gutters mb-4 mb-sm-0">
                    <i class="logo-icon icon-calendar-today mr-4"></i>
                    <span class="logo-text h4">ご予約カレンダー</span>

                </div>

                <!-- TOOLBAR -->
                <div class="toolbar row no-gutters align-items-center">

                    <button type="button" class="btn btn-icon" aria-label="Search">
                        <i class="icon icon-magnify"></i>
                    </button>

                    <button id="calendar-today-button" type="button" class="btn btn-icon" aria-label="Today">
                        <i class="icon icon-calendar-today"></i>
                    </button>

                    <button type="button" class="btn btn-icon change-view" data-view="agendaDay" aria-label="Day">
                        <i class="icon icon-view-day"></i>
                    </button>

                    <button type="button" class="btn btn-icon change-view" data-view="agendaWeek" aria-label="Week">
                        <i class="icon icon-view-week"></i>
                    </button>

                    <button type="button" class="btn btn-icon change-view" data-view="month" aria-label="Month">
                        <i class="icon icon-view-module"></i>
                    </button>
                </div>
                <!-- / TOOLBAR -->
            </div>
            <!-- / HEADER TOP -->

            <!-- HEADER BOTTOM -->
            <div class="header-bottom row align-items-center justify-content-center">

                <button id="calendar-previous-button" type="button" class="btn btn-icon" aria-label="Previous">
                    <i class="icon icon-chevron-left"></i>
                </button>

                <div id="calendar-view-title" class="h5">
                    
                </div>

                <button id="calendar-next-button" type="button" class="btn btn-icon" aria-label="Next">
                    <i class="icon icon-chevron-right"></i>
                </button>
            </div>
            <!-- / HEADER BOTTOM -->
        </div>
        <!-- / HEADER CONTENT -->

    </div>
    <!-- / HEADER -->

    <!-- CONTENT -->
    <div class="page-content bg-white-500">
        <div id="calendar-view"></div>
    </div>
    <!-- / CONTENT -->
</div>
