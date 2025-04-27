// assets/calendar.js
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';

document.addEventListener('DOMContentLoaded', () => {
    console.log('✅ Calendar script loaded!');

    const calendarBtn = document.getElementById('calendar-view-btn');
    const calendarHolder = document.getElementById('calendar-holder');
    const calendarCloseHolder = document.getElementById('calendar-close-holder'); // Already there

    if (!calendarBtn || !calendarHolder || !calendarCloseHolder) {
        console.error('❌ Required elements not found!');
        return;
    }

    let calendarInstance = null;
    let closeButtonCreated = false; // Track if we already created the close button

    calendarBtn.addEventListener('click', () => {
        console.log('✅ Button clicked!');

        try {
            if (!calendarInstance) {
                console.log('Initializing calendar for the first time...');

                const eventsData = calendarHolder.dataset.events;
                const events = JSON.parse(eventsData || '[]');
                console.log('📅 Events to render:', events);

                // Initialize FullCalendar
                calendarInstance = new Calendar(calendarHolder, {
                    plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    events: events.map(event => ({
                        id: event.id,
                        title: event.name,
                        start: event.date,
                        allDay: true
                    })),
                    eventClick: function(info) {
                        window.location.href = `/event/${info.event.id}`;
                    }
                });

                calendarInstance.render();
                console.log('✅ Calendar successfully initialized!');
            }

            // Show calendar
            calendarHolder.style.display = 'block';

            // Create close button if not already created
            if (!closeButtonCreated) {
                const closeButton = document.createElement('button');
                closeButton.innerText = 'Close Calendar';
                closeButton.style.cssText = `
                    margin-top: 15px;
                    padding: 10px 20px;
                    background-color: #e53e3e;
                    color: white;
                    border: none;
                    border-radius: 8px;
                    font-weight: bold;
                    cursor: pointer;
                    transition: background-color 0.3s ease;
                `;

                closeButton.addEventListener('mouseenter', () => {
                    closeButton.style.backgroundColor = '#c53030';
                });

                closeButton.addEventListener('mouseleave', () => {
                    closeButton.style.backgroundColor = '#e53e3e';
                });

                closeButton.addEventListener('click', () => {
                    calendarHolder.style.display = 'none';
                    closeButton.style.display = 'none';
                });

                calendarCloseHolder.appendChild(closeButton);
                closeButtonCreated = true;
            }

            calendarHolder.scrollIntoView({ behavior: 'smooth' });

        } catch (error) {
            console.error('❌ Calendar initialization failed:', error);
            alert('Failed to load calendar. Please refresh the page and try again.');
        }
    });
});
