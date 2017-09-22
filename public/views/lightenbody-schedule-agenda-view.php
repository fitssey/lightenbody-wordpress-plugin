<div class="lb-schedule-wrapper">
    <?php if($schedule): ?>
        <?php foreach($schedule as $item): ?>
            <div class="lb-schedule-day-wrapper">
                <h3 class="lb-schedule-day"><?php echo date_i18n('l, d F Y', strtotime($item->date)); ?></h3>
                <table class="lb-schedule">
                    <thead class="lb-schedule-table-head">
                    <tr>
                        <th class="lb-schedule-table-head-time"><?php echo $options['time_translation']; ?></th>
                        <th class="lb-schedule-table-head-class"><?php echo $options['class_translation']; ?></th>
                        <th class="lb-schedule-table-head-member"><?php echo $options['teacher_translation']; ?></th>
                        <th class="lb-schedule-table-head-level"><?php echo $options['level_translation']; ?></th>
                        <th class="lb-schedule-table-head-location"><?php echo $options['location_translation']; ?></th>
                        <th class="lb-schedule-table-head-booking"></th>
                    </tr>
                    </thead>
                    <tbody class="lb-schedule-table-body">
                    <?php if(!isset($item->scheduleEvents)): ?>
                        <tr><td class="lb-schedule-table-body-error-message" colspan="6"><?php echo $options['no_classes_today_translation']; ?></td></tr>
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
                                        <td class="lb-schedule-table-body-booking-past"><?php echo $options['class_ended_translation']; ?></td>
                                    <?php elseif($scheduleEvent->isCancelled): ?>
                                        <td class="lb-schedule-table-body-booking-cancelled"><?php echo $options['class_cancelled_translation']; ?></td>
                                    <?php else: ?>
                                        <?php $parameters = http_build_query([
                                            'referenceIds'              => [$scheduleEvent->referenceId],
                                            '_locale'                   => $locale,
                                            'lightenbody-api-source'    => $apiSource
                                        ]); ?>
                                        <?php $url = sprintf("$baseUrl/%s/frontoffice,iframe/delegate?%s", $uuid, $parameters); ?>
                                        <td class="lb-schedule-table-body-booking"><a class="lb-schedule-body-booking-link" href="<?php echo $url; ?>"><?php echo $options['book_now_translation']; ?></a></td>
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
        <p class="lb-schedule-error-message"><?php echo $options['no_public_schedule_translation']; ?></p>
    <?php endif;?>
</div>

