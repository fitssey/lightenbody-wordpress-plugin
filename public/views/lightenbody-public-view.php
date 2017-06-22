<div class="lb-schedule-wrapper">
    <?php if($schedule): ?>
        <?php foreach($schedule as $item): ?>
            <div class="lb-schedule-day-wrapper">
                <h3 class="lb-schedule-day"><?php echo date_i18n('l, d F Y', strtotime($item->date)); ?></h3>
                <table class="lb-schedule">
                    <thead class="lb-schedule-table-head">
                    <tr>
                        <th class="lb-schedule-table-head-time">Czas</th>
                        <th class="lb-schedule-table-head-class">Klasa</th>
                        <th class="lb-schedule-table-head-member">Nauczyciel</th>
                        <th class="lb-schedule-table-head-level">Poziom</th>
                        <th class="lb-schedule-table-head-location">Lokalizacja</th>
                        <th class="lb-schedule-table-head-booking"></th>
                    </tr>
                    </thead>
                    <tbody class="lb-schedule-table-body">
                    <?php if(!isset($item->scheduleEvents)): ?>
                        <tr><td class="lb-schedule-table-body-error-message" colspan="6">Brak zajęć na dziś</td></tr>
                    <?php else: ;?>
                        <?php foreach($item->scheduleEvents as $scheduleEvent): ?>
                            <?php if(!$scheduleEvent->isHidden): ?>
                                <tr id="<?php echo $scheduleEvent->referenceId; ?>">
                                    <td class="lb-schedule-table-body-time"><?php echo $scheduleEvent->startTime . ' &ndash; ' . $scheduleEvent->endTime; ?></td>
                                    <td class="lb-schedule-table-body-class"><?php echo $scheduleEvent->scheduleMeta->classService->name->{"$locale"}->value; ?></td>
                                    <td class="lb-schedule-table-body-member"><?php echo $scheduleEvent->member->user->fullName; ?></td>
                                    <td class="lb-schedule-table-body-level"><?php echo $scheduleEvent->scheduleMeta->classService->experienceLevel->name->{"$locale"}->value; ?></td>
                                    <td class="lb-schedule-table-body-location"><?php echo $scheduleEvent->room->location->name->{"$locale"}->value; ?></td>
                                    <?php if($scheduleEvent->hasStarted): ?>
                                        <td class="lb-schedule-table-body-booking-past">Zakończone</td>
                                    <?php elseif($scheduleEvent->isCancelled): ?>
                                        <td class="lb-schedule-table-body-booking-cancelled">Anulowane</td>
                                    <?php else: ?>
                                        <?php $url = sprintf('https://studio.lightenbody.com/%s/frontoffice,iframe/delegate?referenceId=%s&_locale=%s&lightenbody-api-source=%s', $uuid, $scheduleEvent->referenceId, $locale, $apiSource); ?>
                                        <td class="lb-schedule-table-body-booking"><a class="lb-schedule-body-booking-link" href="<?php echo $url; ?>">Zapisz się</a></td>
                                    <?php endif; ?>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif;?>
                    </tbody>
                </table>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="lb-schedule-error-message">Brak zajęć.</p>
    <?php endif;?>
</div>

