<template>
    <div class="restaurant-show">
        <HeaderWhite/>
        <!-- RESTAURANT DESCRIPTION -->
        <div class="restaurant_description" v-if="my_restaurant">

            <div v-show="cardShow != null" class="selectQty">
            <div class="sub-container-cards" v-for="product in my_restaurant.products" :key="product.id">
                <div class="card-box" v-if="cardShow == product.id">
                    <svg @click="closeCard" height="24" width="24" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-abe5c41af1b9498e ccl-c738ab1fde928049"><path d="M12.0001 10.2322L5.88398 4.11612L4.11621 5.88389L10.2323 12L4.11621 18.1161L5.88398 19.8839L12.0001 13.7678L18.1162 19.8839L19.884 18.1161L13.7679 12L19.884 5.88389L18.1162 4.11612L12.0001 10.2322Z"></path></svg>
                    <h3>{{product.name}}</h3>
                    <span class="description">{{product.description}}</span>
                    <div class="qty">
                        <svg @click="decQty" height="24" width="24" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-abe5c41af1b9498e"><path d="M12 2C17.5228 2 22 6.47725 22 12C22 17.5228 17.5228 22 12 22C6.47717 22 2 17.5228 2 12C2 6.47725 6.47717 2 12 2ZM12 20C16.4113 20 20 16.4113 20 12C20 7.58875 16.4113 4 12 4C7.58875 4 4 7.58875 4 12C4 16.4113 7.58875 20 12 20ZM7 13.5V10.5H17V13.5H7Z"></path></svg>
                        <input disabled="disabled" v-model="qty">
                        <svg @click="addQty" height="24" width="24" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-abe5c41af1b9498e"><path d="M12 2C17.5228 2 22 6.47725 22 12C22 17.5228 17.5228 22 12 22C6.47717 22 2 17.5228 2 12C2 6.47725 6.47717 2 12 2ZM12 20C16.4113 20 20 16.4113 20 12C20 7.58875 16.4113 4 12 4C7.58875 4 4 7.58875 4 12C4 16.4113 7.58875 20 12 20ZM13.5 7V10.4999H17V13.5H13.5V17H10.5V13.5H7V10.4999H10.5V7H13.5Z"></path></svg>
                    </div>
                    <div class="actions">
                        <button @click="remove(product.id)" class="delete">Cancella</button>
                        <button @click="add(product)" class="total">TOTALE {{product.price*qty}} €</button>
                    </div>
                </div>
            </div>
        </div>

            <div class="my_container">
                <div class="left">
                    <div class="link">
                        <router-link class="router-link" to="/">Home</router-link>
                        / {{my_restaurant.restaurant.name}}
                    </div>
                    <h1>{{my_restaurant.restaurant.name}}</h1>
                    <div class="description">
                        <div class="tipologies">
                            <span v-for="(tipology, index) in my_restaurant.restaurant.tipologies" :key="tipology.id" >
                                {{tipology.name}}
                                <span v-if="index+1 < my_restaurant.restaurant.tipologies.length"> &bull; </span>
                            </span>
                        </div>
                        <span>{{my_restaurant.restaurant.address}}</span>
                        <span>telefono: {{my_restaurant.restaurant.phone_number}}</span>
                    </div>
                    <div class="slogan">Ordina il tuo piatto preferito a casa tua da {{my_restaurant.restaurant.name}} {{my_restaurant.restaurant.address}} grazie alla consegna a domicilio di Deliveboo.</div>

                    <div class="m-rider">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="24" height="24"><circle cx="24" cy="24" r="24" fill="#EAEAEA"></circle><path fill="#F96" d="M27.381 2.106c-1.098 0-2.032.388-2.808 1.164-.776.776-1.164 1.711-1.164 2.809 0 1.097.388 2.032 1.164 2.808.776.776 1.71 1.164 2.808 1.164 1.097 0 2.032-.388 2.808-1.164.776-.776 1.164-1.711 1.164-2.808 0-1.098-.388-2.033-1.164-2.809a3.831 3.831 0 0 0-2.808-1.164z"></path><path fill="#98006C" d="M28.582.203c-1.415-.321-2.734-.092-3.954.684-1.171.739-1.932 1.78-2.29 3.122L32.61 6.282c.259-1.367.018-2.631-.72-3.788-.791-1.22-1.893-1.98-3.308-2.29z"></path><path fill="#440063" d="M9.22 29.413H9.2c-2.538.015-4.714.92-6.521 2.716C.894 33.93 0 36.094 0 38.633c0 2.564.898 4.737 2.697 6.522 1.796 1.81 3.973 2.716 6.522 2.716 2.55 0 4.72-.902 6.504-2.698 1.81-1.8 2.716-3.972 2.716-6.522 0-2.55-.902-4.73-2.698-6.54-1.796-1.781-3.972-2.68-6.522-2.698zm-1.072 2.66c.343-.047.694-.07 1.053-.073h.018c.459.004.895.048 1.312.13a6.242 6.242 0 0 1 2.347.96c.373.24.724.525 1.053.85h-.019c1.293 1.304 1.94 2.875 1.94 4.711 0 1.837-.654 3.4-1.958 4.693-1.282 1.293-2.842 1.94-4.675 1.94-1.829 0-3.388-.647-4.674-1.94l-.018.019c-1.301-1.286-1.955-2.85-1.959-4.693-.011-1.848.628-3.426 1.922-4.73a6.728 6.728 0 0 1 1.552-1.145 6.236 6.236 0 0 1 1.755-.647c.118-.022.233-.048.35-.074z"></path><path fill="#999" d="M10.531 32.13a7.5 7.5 0 0 0-1.312-.111 8.463 8.463 0 0 0-1.071.055 9.574 9.574 0 0 1-.351.074c-.617.125-1.201.343-1.756.646A6.729 6.729 0 0 0 4.49 33.94c-1.293 1.304-1.932 2.882-1.921 4.73.004 1.844.658 3.407 1.958 4.693l.019-.019 1.792-1.829c-.79-.78-1.182-1.73-1.182-2.845v-.019c-.011-1.123.377-2.084 1.164-2.882.798-.787 1.758-1.175 2.882-1.164h.018c1.135 0 2.103.396 2.901 1.183l1.792-1.848h.019a6.513 6.513 0 0 0-1.053-.85 6.193 6.193 0 0 0-2.347-.96z"></path><path fill="#440063" d="M32.24 32.148c-1.785 1.8-2.679 3.965-2.679 6.503 0 2.565.898 4.737 2.697 6.522 1.796 1.81 3.973 2.716 6.522 2.716 2.55 0 4.72-.901 6.504-2.697 1.81-1.8 2.716-3.973 2.716-6.522 0-2.55-.902-4.73-2.698-6.54-1.795-1.782-3.968-2.683-6.522-2.698h-.018c-2.542.015-4.715.92-6.522 2.716zm5.118.018a9.74 9.74 0 0 0 .35-.074c.345-.048.696-.07 1.054-.073h.018c.459.003.895.047 1.312.129a6.24 6.24 0 0 1 2.347.96c.373.24.724.525 1.053.85h-.019c1.294 1.305 1.94 2.875 1.94 4.712 0 1.836-.654 3.4-1.958 4.693-1.282 1.293-2.842 1.94-4.675 1.94-1.829 0-3.388-.647-4.674-1.94l-.018.018c-1.301-1.286-1.955-2.849-1.959-4.693-.01-1.847.628-3.425 1.922-4.73a6.735 6.735 0 0 1 1.552-1.145 6.306 6.306 0 0 1 1.755-.647z"></path><path fill="#999" d="M37.71 32.092a9.786 9.786 0 0 1-.352.074 6.232 6.232 0 0 0-1.755.647 6.735 6.735 0 0 0-1.552 1.145c-1.293 1.305-1.933 2.883-1.922 4.73.004 1.844.658 3.407 1.959 4.693l.018-.018 1.793-1.83c-.791-.78-1.183-1.729-1.183-2.845v-.018c-.01-1.124.377-2.084 1.164-2.883.798-.786 1.759-1.175 2.882-1.163h.019c1.134 0 2.102.395 2.9 1.182l1.793-1.848h.018a6.508 6.508 0 0 0-1.053-.85 6.187 6.187 0 0 0-2.346-.96 7.509 7.509 0 0 0-1.312-.111c-.37 0-.728.018-1.072.055z"></path><path fill="#F96" d="M35.787 21.173l-1.034 1.035a1.404 1.404 0 0 0-.425 1.072c0 .417.14.775.425 1.071l1.034 1.035c.296.295.658.436 1.09.425a1.38 1.38 0 0 0 1.053-.425l1.035-1.035a1.48 1.48 0 0 0 .444-1.09c0-.406-.148-.758-.444-1.053l-1.035-1.035a1.421 1.421 0 0 0-1.071-.443c-.421 0-.776.148-1.072.443z"></path><path fill="#999" d="M23.26 15.483l11.308 7.704 2.494-2.734-10.31-9.423-3.491 4.453z"></path><path fill="#440063" d="M20.896 21.377a2.465 2.465 0 0 0-1.349-1.442 2.458 2.458 0 0 0-1.958-.092 2.569 2.569 0 0 0-1.46 1.349 2.506 2.506 0 0 0-.092 1.977l5.598 15.187c.255.672.706 1.16 1.349 1.46a2.458 2.458 0 0 0 1.977.073 2.488 2.488 0 0 0 1.46-1.349c.302-.642.325-1.3.073-1.977l-5.598-15.187z"></path><path fill="#FA5058" d="M32.794 21.986a1.1 1.1 0 0 0-.646.203 1.11 1.11 0 0 0-.37.555 1 1 0 0 0 .037.665l.85 2.217H17.59a.933.933 0 0 0-.203 0 1.116 1.116 0 0 0-.444.13l-.018.018c-.03.018-.06.037-.093.055-.033.03-.07.063-.11.093-.004.018-.019.029-.037.036a.942.942 0 0 1-.093.13v.018L8.203 38.56a1.09 1.09 0 0 0-.166.72c.04.27.159.492.351.666.203.173.44.258.702.258h13.321c.126.011.251 0 .37-.037a.217.217 0 0 0 .074-.018.07.07 0 0 0 .037-.019h.018a.867.867 0 0 0 .351-.24.527.527 0 0 0 .11-.11l10.31-11.4 4.084 10.771c.114.274.303.47.572.591a.976.976 0 0 0 .795.019c.277-.104.473-.288.59-.554a.961.961 0 0 0 .02-.795l-4.25-11.233c-.007-.03-.022-.06-.037-.093l-.24-.646v-.019a.502.502 0 0 0-.074-.203l-.037-.13a1.021 1.021 0 0 0-.074-.184l-.702-1.81h1.81c.293 0 .54-.104.74-.315.21-.2.314-.447.314-.739s-.104-.543-.314-.757c-.2-.2-.447-.296-.74-.296h-3.343zM11.067 38.097l6.17-9.182 3.715 9.182h-9.885zm11.806-.905l-3.824-9.46h12.378l-8.554 9.46z"></path><path fill="#999" d="M19.843 39.372c0 1.035.362 1.914 1.09 2.642.739.739 1.626 1.108 2.66 1.108 1.024 0 1.903-.37 2.642-1.108.74-.728 1.109-1.608 1.109-2.642 0-1.035-.37-1.922-1.109-2.66-.739-.729-1.618-1.09-2.642-1.09a3.655 3.655 0 0 0-2.66 1.09 3.655 3.655 0 0 0-1.09 2.66z"></path><path fill="#007E89" d="M18.088 40.277l3.288.407 6.134-11.178c.743-1.423.588-2.561-.461-3.418l-5.044-3.492 1.293-2.457H13.5c-1.689 3.203-.97 5.439 2.74 6.706l6.467 2.458-4.62 10.974z"></path><path fill="#999" d="M25.681 15.169l5.654-3.973-9.35-3.769-.11.185.259 2.494c-1.09-.266-2.077.2-2.956 1.404-.012.019-.023.037-.037.056l-5.931 8.573h10.088l2.383-4.97z"></path><path fill="#007E89" d="M18.217 41.367c.174.396.455.673.85.832l3.843 1.496c.395.16.787.155 1.182-.018a1.45 1.45 0 0 0 .813-.85l.019-.019a1.508 1.508 0 0 0-.037-1.182c-.174-.395-.492-.82-.96-1.275l-2.976-2.79c-.897.998-1.544 1.582-1.94 1.755-.38.16-.646.444-.794.85l-.018.019a1.56 1.56 0 0 0 .018 1.182zM12.804 20.915L20.97 8.96 9.016.794.85 12.748l11.954 8.167z"></path></svg>
                    <span>Consegna fra 50 - 75 min</span>
                    </div>
                    
                    <div class="information">
                        <svg height="24" width="24" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-abe5c41af1b9498e ccl-94235a1794a6d4be"><path d="M12 2C17.5228 2 22 6.47717 22 12C22 17.5228 17.5228 22 12 22C6.47717 22 2 17.5228 2 12C2 6.47717 6.47717 2 12 2ZM12 20C16.4112 20 20 16.4112 20 12C20 7.5888 16.4112 4 12 4C7.5888 4 4 7.5888 4 12C4 16.4112 7.5888 20 12 20ZM11 17V10H13V17H11ZM11.9934 6.69997C12.7444 6.69997 13.2846 7.22697 13.2846 7.91205C13.2846 8.59722 12.7444 9.13738 11.9934 9.13738C11.2556 9.13738 10.7155 8.59722 10.7155 7.91205C10.7155 7.22697 11.2556 6.69997 11.9934 6.69997Z"></path></svg>
                        <div>
                            Informazioni sul ristorante
                        </div>
                    </div>
                </div>
                <div class="right">
                    <div class="container-img">
                        <img v-if="my_restaurant.restaurant.image" :src="/storage/ + my_restaurant.restaurant.image" :alt="my_restaurant.restaurant.name">
                    </div>
                    <div class="rider">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="24" height="24"><circle cx="24" cy="24" r="24" fill="#EAEAEA"></circle><path fill="#F96" d="M27.381 2.106c-1.098 0-2.032.388-2.808 1.164-.776.776-1.164 1.711-1.164 2.809 0 1.097.388 2.032 1.164 2.808.776.776 1.71 1.164 2.808 1.164 1.097 0 2.032-.388 2.808-1.164.776-.776 1.164-1.711 1.164-2.808 0-1.098-.388-2.033-1.164-2.809a3.831 3.831 0 0 0-2.808-1.164z"></path><path fill="#98006C" d="M28.582.203c-1.415-.321-2.734-.092-3.954.684-1.171.739-1.932 1.78-2.29 3.122L32.61 6.282c.259-1.367.018-2.631-.72-3.788-.791-1.22-1.893-1.98-3.308-2.29z"></path><path fill="#440063" d="M9.22 29.413H9.2c-2.538.015-4.714.92-6.521 2.716C.894 33.93 0 36.094 0 38.633c0 2.564.898 4.737 2.697 6.522 1.796 1.81 3.973 2.716 6.522 2.716 2.55 0 4.72-.902 6.504-2.698 1.81-1.8 2.716-3.972 2.716-6.522 0-2.55-.902-4.73-2.698-6.54-1.796-1.781-3.972-2.68-6.522-2.698zm-1.072 2.66c.343-.047.694-.07 1.053-.073h.018c.459.004.895.048 1.312.13a6.242 6.242 0 0 1 2.347.96c.373.24.724.525 1.053.85h-.019c1.293 1.304 1.94 2.875 1.94 4.711 0 1.837-.654 3.4-1.958 4.693-1.282 1.293-2.842 1.94-4.675 1.94-1.829 0-3.388-.647-4.674-1.94l-.018.019c-1.301-1.286-1.955-2.85-1.959-4.693-.011-1.848.628-3.426 1.922-4.73a6.728 6.728 0 0 1 1.552-1.145 6.236 6.236 0 0 1 1.755-.647c.118-.022.233-.048.35-.074z"></path><path fill="#999" d="M10.531 32.13a7.5 7.5 0 0 0-1.312-.111 8.463 8.463 0 0 0-1.071.055 9.574 9.574 0 0 1-.351.074c-.617.125-1.201.343-1.756.646A6.729 6.729 0 0 0 4.49 33.94c-1.293 1.304-1.932 2.882-1.921 4.73.004 1.844.658 3.407 1.958 4.693l.019-.019 1.792-1.829c-.79-.78-1.182-1.73-1.182-2.845v-.019c-.011-1.123.377-2.084 1.164-2.882.798-.787 1.758-1.175 2.882-1.164h.018c1.135 0 2.103.396 2.901 1.183l1.792-1.848h.019a6.513 6.513 0 0 0-1.053-.85 6.193 6.193 0 0 0-2.347-.96z"></path><path fill="#440063" d="M32.24 32.148c-1.785 1.8-2.679 3.965-2.679 6.503 0 2.565.898 4.737 2.697 6.522 1.796 1.81 3.973 2.716 6.522 2.716 2.55 0 4.72-.901 6.504-2.697 1.81-1.8 2.716-3.973 2.716-6.522 0-2.55-.902-4.73-2.698-6.54-1.795-1.782-3.968-2.683-6.522-2.698h-.018c-2.542.015-4.715.92-6.522 2.716zm5.118.018a9.74 9.74 0 0 0 .35-.074c.345-.048.696-.07 1.054-.073h.018c.459.003.895.047 1.312.129a6.24 6.24 0 0 1 2.347.96c.373.24.724.525 1.053.85h-.019c1.294 1.305 1.94 2.875 1.94 4.712 0 1.836-.654 3.4-1.958 4.693-1.282 1.293-2.842 1.94-4.675 1.94-1.829 0-3.388-.647-4.674-1.94l-.018.018c-1.301-1.286-1.955-2.849-1.959-4.693-.01-1.847.628-3.425 1.922-4.73a6.735 6.735 0 0 1 1.552-1.145 6.306 6.306 0 0 1 1.755-.647z"></path><path fill="#999" d="M37.71 32.092a9.786 9.786 0 0 1-.352.074 6.232 6.232 0 0 0-1.755.647 6.735 6.735 0 0 0-1.552 1.145c-1.293 1.305-1.933 2.883-1.922 4.73.004 1.844.658 3.407 1.959 4.693l.018-.018 1.793-1.83c-.791-.78-1.183-1.729-1.183-2.845v-.018c-.01-1.124.377-2.084 1.164-2.883.798-.786 1.759-1.175 2.882-1.163h.019c1.134 0 2.102.395 2.9 1.182l1.793-1.848h.018a6.508 6.508 0 0 0-1.053-.85 6.187 6.187 0 0 0-2.346-.96 7.509 7.509 0 0 0-1.312-.111c-.37 0-.728.018-1.072.055z"></path><path fill="#F96" d="M35.787 21.173l-1.034 1.035a1.404 1.404 0 0 0-.425 1.072c0 .417.14.775.425 1.071l1.034 1.035c.296.295.658.436 1.09.425a1.38 1.38 0 0 0 1.053-.425l1.035-1.035a1.48 1.48 0 0 0 .444-1.09c0-.406-.148-.758-.444-1.053l-1.035-1.035a1.421 1.421 0 0 0-1.071-.443c-.421 0-.776.148-1.072.443z"></path><path fill="#999" d="M23.26 15.483l11.308 7.704 2.494-2.734-10.31-9.423-3.491 4.453z"></path><path fill="#440063" d="M20.896 21.377a2.465 2.465 0 0 0-1.349-1.442 2.458 2.458 0 0 0-1.958-.092 2.569 2.569 0 0 0-1.46 1.349 2.506 2.506 0 0 0-.092 1.977l5.598 15.187c.255.672.706 1.16 1.349 1.46a2.458 2.458 0 0 0 1.977.073 2.488 2.488 0 0 0 1.46-1.349c.302-.642.325-1.3.073-1.977l-5.598-15.187z"></path><path fill="#FA5058" d="M32.794 21.986a1.1 1.1 0 0 0-.646.203 1.11 1.11 0 0 0-.37.555 1 1 0 0 0 .037.665l.85 2.217H17.59a.933.933 0 0 0-.203 0 1.116 1.116 0 0 0-.444.13l-.018.018c-.03.018-.06.037-.093.055-.033.03-.07.063-.11.093-.004.018-.019.029-.037.036a.942.942 0 0 1-.093.13v.018L8.203 38.56a1.09 1.09 0 0 0-.166.72c.04.27.159.492.351.666.203.173.44.258.702.258h13.321c.126.011.251 0 .37-.037a.217.217 0 0 0 .074-.018.07.07 0 0 0 .037-.019h.018a.867.867 0 0 0 .351-.24.527.527 0 0 0 .11-.11l10.31-11.4 4.084 10.771c.114.274.303.47.572.591a.976.976 0 0 0 .795.019c.277-.104.473-.288.59-.554a.961.961 0 0 0 .02-.795l-4.25-11.233c-.007-.03-.022-.06-.037-.093l-.24-.646v-.019a.502.502 0 0 0-.074-.203l-.037-.13a1.021 1.021 0 0 0-.074-.184l-.702-1.81h1.81c.293 0 .54-.104.74-.315.21-.2.314-.447.314-.739s-.104-.543-.314-.757c-.2-.2-.447-.296-.74-.296h-3.343zM11.067 38.097l6.17-9.182 3.715 9.182h-9.885zm11.806-.905l-3.824-9.46h12.378l-8.554 9.46z"></path><path fill="#999" d="M19.843 39.372c0 1.035.362 1.914 1.09 2.642.739.739 1.626 1.108 2.66 1.108 1.024 0 1.903-.37 2.642-1.108.74-.728 1.109-1.608 1.109-2.642 0-1.035-.37-1.922-1.109-2.66-.739-.729-1.618-1.09-2.642-1.09a3.655 3.655 0 0 0-2.66 1.09 3.655 3.655 0 0 0-1.09 2.66z"></path><path fill="#007E89" d="M18.088 40.277l3.288.407 6.134-11.178c.743-1.423.588-2.561-.461-3.418l-5.044-3.492 1.293-2.457H13.5c-1.689 3.203-.97 5.439 2.74 6.706l6.467 2.458-4.62 10.974z"></path><path fill="#999" d="M25.681 15.169l5.654-3.973-9.35-3.769-.11.185.259 2.494c-1.09-.266-2.077.2-2.956 1.404-.012.019-.023.037-.037.056l-5.931 8.573h10.088l2.383-4.97z"></path><path fill="#007E89" d="M18.217 41.367c.174.396.455.673.85.832l3.843 1.496c.395.16.787.155 1.182-.018a1.45 1.45 0 0 0 .813-.85l.019-.019a1.508 1.508 0 0 0-.037-1.182c-.174-.395-.492-.82-.96-1.275l-2.976-2.79c-.897.998-1.544 1.582-1.94 1.755-.38.16-.646.444-.794.85l-.018.019a1.56 1.56 0 0 0 .018 1.182zM12.804 20.915L20.97 8.96 9.016.794.85 12.748l11.954 8.167z"></path></svg>
                        <span>Consegna fra 50 - 75 min</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- MENU -->
        <div class="menu">
            <div class="my_container">
                <div class="left">
                    <div>
                        <span class="first-3" v-for="(category, index) in my_categories" :key="index">
                            <a @click="selected(index)" :class="{active: index == indexCategory}" :href="'#'+category">
                                {{category}}
                            </a>
                        </span>
                    </div>
                </div>
                <!-- CART -->
                <div class="cart">
                    <div v-if="total === 0" class="empty">
                        <span>
                            <svg height="24" width="24" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205 ccl-12dd3e73f2b804e2"><path d="M4.82843 13L11 19.1716L18 12.1716V6H11.8284L4.82843 13ZM11 4H20V13L11 22L2 13L11 4ZM14.5 11C15.3284 11 16 10.3284 16 9.5C16 8.67157 15.3284 8 14.5 8C13.6716 8 13 8.67157 13 9.5C13 10.3284 13.6716 11 14.5 11Z"></path></svg>
                            Inserisci almeno 1 articolo, consegna gratuita
                        </span>
                        <div class="divider"></div>
                        <button>Vai alla cassa</button>
                        <div>
                            Il tuo carrello è vuoto
                        </div>
                    </div>
                    <div v-else class="full">
                        <div class="container-full">
                            <span>
                                <svg height="24" width="24" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205 ccl-b86ddb4586c18dbc"><path d="M12 2C17.5228 2 22 6.47725 22 12C22 17.5228 17.5228 22 12 22C6.47717 22 2 17.5228 2 12C2 6.47725 6.47717 2 12 2ZM8 10.8787L5.87868 13L10 17.1213L18.1213 9L16 6.87868L10 12.8787L8 10.8787Z"></path></svg>
                                <span>Congratulazioni! Ora <strong> la consegna è gratuita</strong></span>
                            </span>
                            <div class="divider"></div>
                            
                            <router-link class="pay" :to="{name: 'payment',
                                params: {
                                    restaurant: my_restaurant.restaurant,
                                    restaurantId: cart.key,
                                    orderTotal: total
                                }}">
                                Vai alla cassa
                            </router-link>
                            <div class="recap" v-for="product in cart.products" :key="product.id">
                                <div class="qty">
                                    <svg @click="cartDecrement(product.id)" height="24" width="24" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205"><path d="M12 2C17.5228 2 22 6.47725 22 12C22 17.5228 17.5228 22 12 22C6.47717 22 2 17.5228 2 12C2 6.47725 6.47717 2 12 2ZM12 20C16.4113 20 20 16.4113 20 12C20 7.58875 16.4113 4 12 4C7.58875 4 4 7.58875 4 12C4 16.4113 7.58875 20 12 20ZM7 13.5V10.5H17V13.5H7Z"></path></svg>
                                    {{product.qty}}
                                    <svg @click="cartIncrement(product.id)" height="24" width="24" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205"><path d="M12 2C17.5228 2 22 6.47725 22 12C22 17.5228 17.5228 22 12 22C6.47717 22 2 17.5228 2 12C2 6.47725 6.47717 2 12 2ZM12 20C16.4113 20 20 16.4113 20 12C20 7.58875 16.4113 4 12 4C7.58875 4 4 7.58875 4 12C4 16.4113 7.58875 20 12 20ZM13.5 7V10.4999H17V13.5H13.5V17H10.5V13.5H7V10.4999H10.5V7H13.5Z"></path></svg>
                                </div>
                                <div class="name">{{product.name}}</div>
                                <div class="single-total">{{product.total}} €</div>
                            </div>
                            <div class="subtotal">
                                <span>Subtotale</span>
                                <span>{{total}} €</span>
                            </div>
                            <div class="transportation-fee">
                                <span>Spese di trasporto</span>
                                <span>
                                    <svg height="24" width="24" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205 ccl-1e6f880f67285c2e"><path d="M12 2C17.5228 2 22 6.47717 22 12C22 17.5228 17.5228 22 12 22C6.47717 22 2 17.5228 2 12C2 6.47717 6.47717 2 12 2ZM12 20C16.4112 20 20 16.4112 20 12C20 7.5888 16.4112 4 12 4C7.5888 4 4 7.5888 4 12C4 16.4112 7.5888 20 12 20ZM11 17V10H13V17H11ZM11.9934 6.69997C12.7444 6.69997 13.2846 7.22697 13.2846 7.91205C13.2846 8.59722 12.7444 9.13738 11.9934 9.13738C11.2556 9.13738 10.7155 8.59722 10.7155 7.91205C10.7155 7.22697 11.2556 6.69997 11.9934 6.69997Z"></path></svg>
                                    <span class="delete">1,49 € </span>
                                    <span class="free">Gratuito</span>
                                </span>
                            </div>
                        </div>
                        <div class="savings">
                            Con la consegna gratuita risparmi 1,49 €
                        </div>
                        <div class="total">
                            <span>Totale</span>
                            <span>{{total}} €</span>
                        </div>
                        <div class="container-empty"><button @click="removeCart" class="empty-the-cart">Svuota il carrello</button></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-list">
            <div class="my_container">
                <div class="left">
                    <div>
                        <div v-for="category in my_categories" :key="category.id">
                            <h3 :id="category" >{{category}}</h3>
                            <div class="container-cards">
                                <div class="sub-container-cards" v-for="product in products(my_restaurant.products,category)" :key="product.id">
                                    <span @click="openCard(product)" class="card" :class="{active: activeElements.includes(product.id), 'card-visibility':!product.visibility }">
                                        <div class="description-card">
                                            <span>
                                                <span v-for="cartp in cart.products" :key="cartp.id" >
                                                    <span class="cart-qty" v-if="cartp.id == product.id && cartp.qty != 0">{{cartp.qty}}× </span>
                                                </span>
                                                <span class="name">{{product.name}}</span>
                                            </span>
                                            <span class="price">{{product.price}} €</span>
                                            <div v-if="!product.visibility" class="unavailable">
                                                Non disponibile
                                            </div>
                                        </div>
                                        <div class="img">
                                            <img v-if="product.image" :src="/storage/ + product.image" :alt="product.name">
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- MOBILE CART -->
        <div v-if="my_restaurant" class="m-cart" :class="{h100: !showCart}">
            <div class="cart-container" :class="{p0 : !showCart}">
                <div v-if="total === 0" class="empty">
                    <span>
                        <svg height="20" width="20" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205 ccl-12dd3e73f2b804e2"><path d="M4.82843 13L11 19.1716L18 12.1716V6H11.8284L4.82843 13ZM11 4H20V13L11 22L2 13L11 4ZM14.5 11C15.3284 11 16 10.3284 16 9.5C16 8.67157 15.3284 8 14.5 8C13.6716 8 13 8.67157 13 9.5C13 10.3284 13.6716 11 14.5 11Z"></path></svg>
                        Inserisci almeno 1 articolo, consegna gratuita
                    </span>
                    <div class="divider"></div>
                </div>

                <div v-show="showCart" v-else class="something">
                    <span>
                        <svg height="20" width="20" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205 ccl-b86ddb4586c18dbc"><path d="M12 2C17.5228 2 22 6.47725 22 12C22 17.5228 17.5228 22 12 22C6.47717 22 2 17.5228 2 12C2 6.47725 6.47717 2 12 2ZM8 10.8787L5.87868 13L10 17.1213L18.1213 9L16 6.87868L10 12.8787L8 10.8787Z"></path></svg>
                        <span>Congratulazioni! Ora <strong> la consegna è gratuita</strong></span>
                    </span>
                    <div class="divider"></div>
                    <button @click="showContentCart">Vedi il carrello</button>
                </div>

            </div>
            <div class="cart-content" v-show="!showCart">
                <div class="cart-container">
                    <h3>
                        Il mio carrello
                        <button @click="showContentCart">
                            <svg height="20" width="20" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205 ccl-94235a1794a6d4be"><path d="M12.0001 10.2322L5.88398 4.11612L4.11621 5.88389L10.2323 12L4.11621 18.1161L5.88398 19.8839L12.0001 13.7678L18.1162 19.8839L19.884 18.1161L13.7679 12L19.884 5.88389L18.1162 4.11612L12.0001 10.2322Z"></path></svg>
                        </button>
                    </h3>
                    <div>
                        <div class="recap" v-for="product in cart.products" :key="product.id">
                            <div class="qty">
                                <svg @click="cartDecrement(product.id)" height="20" width="20" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205"><path d="M12 2C17.5228 2 22 6.47725 22 12C22 17.5228 17.5228 22 12 22C6.47717 22 2 17.5228 2 12C2 6.47725 6.47717 2 12 2ZM12 20C16.4113 20 20 16.4113 20 12C20 7.58875 16.4113 4 12 4C7.58875 4 4 7.58875 4 12C4 16.4113 7.58875 20 12 20ZM7 13.5V10.5H17V13.5H7Z"></path></svg>
                                {{product.qty}}
                                <svg @click="cartIncrement(product.id)" height="20" width="20" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205"><path d="M12 2C17.5228 2 22 6.47725 22 12C22 17.5228 17.5228 22 12 22C6.47717 22 2 17.5228 2 12C2 6.47725 6.47717 2 12 2ZM12 20C16.4113 20 20 16.4113 20 12C20 7.58875 16.4113 4 12 4C7.58875 4 4 7.58875 4 12C4 16.4113 7.58875 20 12 20ZM13.5 7V10.4999H17V13.5H13.5V17H10.5V13.5H7V10.4999H10.5V7H13.5Z"></path></svg>
                            </div>
                            <div class="name">{{product.name}}</div>
                            <div class="single-total">{{product.total}} €</div>
                        </div>

                        <div class="subtotal">
                            <span>Subtotale</span>
                            <span>{{total}} €</span>
                        </div>
                        <div class="transportation-fee">
                            <span>Spese di trasporto</span>
                            <span>
                                <svg height="24" width="24" viewBox="0 0 24 24" class="ccl-0f24ac4b87ce1f67 ccl-ed34b65f78f16205 ccl-1e6f880f67285c2e"><path d="M12 2C17.5228 2 22 6.47717 22 12C22 17.5228 17.5228 22 12 22C6.47717 22 2 17.5228 2 12C2 6.47717 6.47717 2 12 2ZM12 20C16.4112 20 20 16.4112 20 12C20 7.5888 16.4112 4 12 4C7.5888 4 4 7.5888 4 12C4 16.4112 7.5888 20 12 20ZM11 17V10H13V17H11ZM11.9934 6.69997C12.7444 6.69997 13.2846 7.22697 13.2846 7.91205C13.2846 8.59722 12.7444 9.13738 11.9934 9.13738C11.2556 9.13738 10.7155 8.59722 10.7155 7.91205C10.7155 7.22697 11.2556 6.69997 11.9934 6.69997Z"></path></svg>
                                <span class="delete">1,49 € </span>
                                <span class="free">Gratuito</span>
                            </span>
                        </div>
                        <div class="savings">
                            Con la consegna gratuita risparmi 1,49 €
                        </div>
                    </div>
                </div>

                <div class="buttons">
                    <button @click="removeCart(), showContentCart()" class="empty-the-cart">
                        Svuota il carrello
                    </button>
                    <router-link class="pay" :to="{name: 'payment',
                        params: {
                            restaurant: my_restaurant.restaurant,
                            restaurantId: cart.key,
                            orderTotal: total
                        }}">
                        Vai alla cassa
                    </router-link>
                </div>
            </div>
        </div>

        <Footer/>

    </div>
</template>

<script>
import HeaderWhite from "../components/HeaderWhite.vue";
import Footer from "../components/Footer.vue";
export default {
    name: "RestaurantShow",
    components: {
        HeaderWhite,
        Footer,
    },
    data() {
        return {
            showCart: true,
            my_restaurant: null,
            my_categories: [],
            cart: {
                key: "",
                products: []
            },
            total: 0,
            indexCategory : null,
            cardShow : null,
            qty: null,
            activeElements : [],
            initialPrice : 0,

        };
    },
    created() {
        this.getRestaurant();
    },
    methods: {
        products(array, category) {
            return array.filter(function(e){
                return e.category.name == category
            })
        },

        showContentCart(){
            this.showCart = !this.showCart;
            console.log(this.showCart);
        },

        getRestaurant() {
            axios
                .get(
                    `http://127.0.0.1:8000/api/restaurants/${this.$route.params.slug}`
                )
                .then(res => {
                    this.my_restaurant = res.data;
                    this.cart.key = res.data.restaurant.id;
                    res.data.products.forEach(element => {
                        if (
                            !this.my_categories.includes(element.category.name)
                        ) {
                            this.my_categories.push(element.category.name);
                        }
                    });
                    this.init();
                })
                .catch(err => {
                    console.log(err);
                });
        },

        //AGGIUNTA PRODOTTI NELL'ARRAY CHE POPOLERA IL CART DAL LOCALSTORAGE
        add(product) {
            if (this.find(product.id)) {
                this.total -= this.initialPrice;
                this.increment(product.id);
            } else {
                let obj = {
                    name: product.name,
                    id: product.id,
                    price: product.price,
                    qty: this.qty,
                    total: product.price * this.qty,
                };
                this.activeElements.push(product.id);
                this.cart.products.push(obj);
            }
            this.total += product.price * this.qty;
            console.log(this.total);
            this.sync();
            this.cardShow = null;
        },

        //RIMUOVI PRODOTTI
        remove(id) {
             this.cart.products.forEach((e, index) => {
                if (e.id == id) {
                    this.total -= e.total;
                    this.cart.products.splice(index, 1);
                    this.activeElements.splice(index, 1);
                }
            });
            this.sync();
            this.cardShow = null;
        },

        //SINCRONIZZAZIONE DATI LOCAL STORAGE
        async sync() {
            let content = JSON.stringify(this.cart.products);
            await localStorage.setItem(this.cart.key, content);
        },

        //CONTROLLO SE UN PRODOTTO è GIA PRESENTE NEL CARRELLO
        find(id) {
            let check = undefined;
            this.cart.products.forEach(e => {
                if (e.id == id) {
                    check = true;
                }
            });
            return check;
        },

        //INCREMENTO QTY
        increment(id) {
            this.cart.products = this.cart.products.map(e => {
                if (e.id == id) {
                    e.qty = this.qty;
                    e.total = e.price * e.qty;
                    return e;
                } else {
                    return e;
                }
            });
        },

        // RIMUOVI TUTTO IL CARRELLO
        removeCart(cart) {
            if (cart != 0) {
                this.total = 0;
                this.cart.products = [];
            }
            this.sync();
            this.activeElements = [];
        },
        // INIZIALIZZAZIONE
        init() {
            for (var i = 0; i < localStorage.length; i++) {
                if (this.cart.key != localStorage.key(i)) {
                    localStorage.removeItem(i);
                }
            }
            let contents = localStorage.getItem(this.cart.key);
            if (contents) {
                this.cart.products = JSON.parse(contents);
            }
            this.cart.products.forEach(e => {
                this.total += e.total;
                this.activeElements.push(e.id);
            });
        },
        // SELECTED
        selected(index){
            this.indexCategory = index;
        },
        // OPENCARD
        openCard(product){
            if(product.visibility){
                this.cardShow = product.id;
                this.qty = 1;
                this.cart.products.forEach(e=>{
                    if(e.id == product.id){
                        this.qty = e.qty;
                        this.initialPrice = product.price * e.qty;
                    }
                })
            }
        },
        // CLOSECARD    
        closeCard(){
            this.cardShow = null;
        },
        // ADDQTY
        addQty(){
            this.qty ++;
        },
        // DECQTY
        decQty(){
            if(this.qty >1){
                this.qty --;
            }
        },
        // CART INCREMENT
        cartIncrement(id){
            this.cart.products = this.cart.products.map(e => {
                if (e.id == id) {
                    e.qty += 1;
                    e.total = e.price * e.qty;
                    this.total += e.price;
                    return e;
                } else {
                    return e;
                }
            });
        },
        // CART DECREMENT
        cartDecrement(id){
            this.cart.products.forEach(e => {
                if (e.id == id) {
                    e.qty -= 1;
                    e.total = e.price * e.qty;
                    this.total -= e.price;
                    if (e.qty == 0) {
                        this.cart.products.forEach((e, index) => {
                            if (e.id == id) {
                                this.cart.products.splice(index, 1);
                                this.activeElements.splice(index, 1);
                            }
                        });
                    }
                }
            });
        }
    }
};
</script>

<style scoped lang="scss">
@import '../../sass/vars.scss';
@import '../../sass/general.scss';
@import '../../sass/mixins.scss';

.restaurant-show{
    @include flex("column");
    height: 100%;
}

.m-cart{
    display: none;
}
.m-rider{
    display: none;
}

.restaurant_description{
    background-color:#fff;
    border-bottom: 1px solid $d-grey;
    .my_container{
        padding-top: 29px;
        @include flex("space-bet");
        .left{
            .link{
            padding-bottom: 20px;
            color: $d-text-grey;
            font-size: 14px;
                .router-link{
                    text-decoration: none;
                    color: $d-primary;
                }
            }
            h1{
                color: $d-black;
                font-size: 28px;
            }
            .description{
                @include flex("column");
            }
            .description,
            .slogan{
                color: $d-text-grey;
                font-size: 14px;
            }
            .slogan{
                margin-top: 5px;
            }
            .information{
                margin: 8px 0 16px 0;
                @include flex("vertical");
                svg{
                    margin-right: 8px;
                    color: $d-text-grey;
                    fill: currentColor;
                }
            }
        }
        .right{
            .container-img{
                width: 370px;
                height: 170px;
                img{
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }
            }
            .rider{
                margin-top: 10px;
                @include flex("verical");
                svg{
                    margin-right: 10px;
                }
            }
        }
    }
    .selectQty{
    z-index: 2;
    position: fixed;
    top: 0;
    left: 0;
    overflow: hidden;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0,0,0,.5);
    opacity: 1;
    @include flex("center");
        .card-box{
            @include flex("column");
            opacity: 1;
            width: 560px;
            min-height: 268px;
            padding: 24px;
            background-color: white;
            position: relative;
            & > svg{
                cursor: pointer;
                position: absolute;
                right: 19px;
                top: 19px;
                color: $d-primary;
                fill:currentColor;
            }
            h3{
                font-size: 28px;
                color: $d-black;
            }
            .description{
                font-size: 14px;
                color: $d-text-grey;
            }
            .qty{
                margin-top: 35px;
                @include flex("center");
                svg{
                    cursor: pointer;
                    color: $d-primary;
                    fill:currentColor;
                }
                input{
                    width: 30%;
                    font-weight: bold;
                    font-size: 28px;
                    color: $d-black;
                    text-align: center;
                }
            }
            .actions{
                flex-grow: 1;
                height: 100%;
                @include flex("flex");
                align-items: flex-end;
                .delete{
                    border: 1px solid #e8ebeb;
                    background-color: #fff;
                    color: $d-primary;
                    min-height: 48px;
                    padding: 12px 24px;
                    border-radius: 4px;
                    cursor: pointer;
                    &:hover{
                        border-color: #d1d4d4;
                        color: #00a698;
                    }
                }
                .total{
                    background-color: $d-primary;
                    color: #fff;
                    min-height: 48px;
                    padding: 12px 24px;
                    border-radius: 4px;
                    cursor: pointer;
                    margin-left: 13px;
                    flex-grow: 1;
                }
            }
        }
    }
  
}

.menu{
    top: 0;
    position: sticky;
    background-color: white;
    .my_container{
        display: flex;
        position: relative;
        padding-right: 380px;
        .left{
            width: 100%;
            div{
                @include flex("flex");
                flex-wrap: wrap;
                padding: 10px 0;
                a{  
                    display: block;
                    text-align: center;
                    width: 125px;
                    text-decoration: none;
                    color: $d-primary;
                    border: 3px solid #b2f0eb;
                    margin: 8px;
                    padding: 2px 16px;
                    border-radius: 20px;
                }
                .active{
                    background-color: $d-primary;
                    color: #fff;
                }
            }
        }
        .cart{
            position: absolute;
            right: 0;
            top: 0;
            min-height: 248px;
            width: 369px;
            background-color: #fff;
            .empty{
                padding: 16px;
                @include flex("column");
                min-height: 216px;
                span{
                    @include flex("vertical");
                    color: #e2484f;
                    fill: currentColor;
                    font-size: 14px;
                    margin-bottom: 5px;
                    svg{
                        width: 18px;
                        height: 18px;
                        margin-right: 8px;
                    }
                }
                .divider{
                    background-color: #ebebeb;
                    border-radius: 2px;
                    height: 4px;
                    margin-bottom: 15px;
                    flex-grow: 0;
                }
                button{
                    cursor: not-allowed;
                    width: 100%;
                    height: 56px;
                    background-color: #ebebeb;
                    border-radius: 2px;
                    color: #abadad;
                }
                & > div{
                    flex-grow: 1;
                    color: #abadad;
                    @include flex("center");
                }
            }
            .full{
                .container-full{
                    padding: 16px 16px 0;
                    @include flex("column");
                    min-height: 216px;
                    & > span{
                        @include flex("vertical");
                        fill: #77bf2a;
                        font-size: 14px;
                        margin-bottom: 5px;
                        svg{
                            width: 18px;
                            height: 18px;
                            margin-right: 8px;
                        }
                        strong{
                            margin-left: 4px;
                        }
                    }
                    .divider{
                        background-color: #77bf2a;
                        border-radius: 2px;
                        height: 4px;
                        margin-bottom: 15px;
                        flex-grow: 0;
                    }
                    .pay{
                        @include flex("center");
                        text-decoration: none;
                        width: 100%;
                        height: 56px;
                        background-color: $d-primary;
                        border-radius: 2px;
                        color: #fff;
                    }
                    .recap{
                        margin-top: 20px;
                        @include flex("flex");
                        .qty{
                            @include flex("vertical");
                            justify-content: space-between;
                            width: 20%;
                            color: #828585;
                            svg{
                                cursor: pointer;
                                fill: $d-primary;
                                width: 18px;
                                height: 18px;
                            }
                        }
                        .name{
                            padding-left: 8px;
                            width: 55%;
                            color: #828585;
                        }
                        .single-total{
                            width: 25%;
                            text-align: right;
                        }
                    }
                    .subtotal{
                        margin-top: 25px;
                        @include flex("flex");
                        & > span:first-child{
                            color: #828585;
                        };
                        & > span:last-child{
                            display: block;
                            width: 100%;
                            text-align: right;
                        }
                    }
                    .transportation-fee{
                        margin: 4px 0;
                        @include flex("flex");
                        color: #828585;
                        & > span:last-child{
                            @include flex("vertical");
                            justify-content: flex-end;
                            flex-grow: 1;
                            svg{
                                fill: currentColor;
                                width: 18px;
                                height: 18px;
                                margin-right: 4px;
                            }
                            .delete{
                                text-decoration: line-through;
                                margin-right: 4px;
                            }
                            .free{
                                color: #e2484f;
                            }
                        };
                    }
                }
                .savings{
                    @include flex("center");
                    padding: 10px;
                    background-color: #00a396;
                    color: white;
                }
                .total{
                    color: $d-text-grey;
                    @include flex("flex");
                    padding: 8px 16px;
                    & >span:last-child{
                        width: 100%;
                        text-align: right;
                        color: black;
                    }
                }
                .container-empty{
                    padding: 16px;
                    .empty-the-cart{
                        width: 100%;
                        height: 56px;
                        background-color: #e2484f;
                        border-radius: 2px;
                        color: #fff;
                    }
                }
            }
        }
    }
}

.menu-list{
    flex-grow: 1;
    .my_container{
        padding-right: 380px;
    }
    background-color: #f4f5f5;
    h3{
        color: $d-black;
        font-size: 28px;
    }
   .container-cards{
        @include flex("flex");
        flex-wrap: wrap;
        widows: 100%;
        .sub-container-cards{
            @include flex("flex");
            width: calc(100% / 2 - 20px);
            margin: 10px;
            .card{
                display: flex;
                justify-content: space-between;
                border-left: 4px solid transparent;
                cursor: pointer;
                height: 137px;
                width: 100%;
                background-color: #fff;
                padding: 20px;
                @include flex("flex");
                &:hover{
                    box-shadow: 0px 22px 24px 0px rgba(0,0,0,0.08);
                }
                .description-card{
                    @include flex("column");
                    width:70%;
                    padding-right: 10px;
                    .cart-qty{
                        color: #babbbb;
                    }
                    .price{
                        color: #e2484f;
                    }
                    .unavailable{
                        margin-top: 20px;
                        color: $d-text-grey;
                    }
                }
                .img{
                    min-width: 96px;
                    max-width: 96px;
                    height: 96px;
                    img{
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                    }
                }
            }
            .card-visibility{
                cursor: not-allowed;
            }
            .active{
                border-left: 4px solid $d-primary;
            }
        }
   }
}

@media screen and (max-width: 979px){
    .menu-list{
        .my_container{
            padding-right: 380px;
            h3{
                margin-top: 20px;
            }
        }
    .container-cards{
            .sub-container-cards{
                width: calc(100% - 15px);
                margin: unset;
                border: 1px solid #e8ebeb;
            }
        }
    }
}

@media screen and (max-width: 870px){
    .menu-list{
        .my_container{
            padding-right: 330px;
        }
    }
    .menu{
        .my_container{
            padding-right: 320px;
            
            .cart{
                width: 315px;
            }
        }
    }
}

@media screen and (max-width:767px){
    .restaurant_description{
        .my_container{
            display: flex;
            flex-direction: column-reverse;
            padding: 0;

            .left{
                padding: 0 15px;

                .m-rider{
                    margin-top: 10px;
                    @include flex("verical");
                    svg{
                        margin-right: 10px;
                    }
                }
            }

            .right{
                margin-bottom: 10px;
                .container-img{
                    width: 100%;
                    height: 180px;
                    img{
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                    }
                }

                .rider{
                    display: none;
                }
            }
        }
    }

    .menu-list{
        .my_container{
            padding-right: unset;
        }
    }

    .menu{
        .my_container{
            padding-right: unset;
            
            .cart{
                display: none;
            }
        }
    }

    .h100{
        height: 100%;
    }
    
    .m-cart{
        display: block;
        position: fixed;
        bottom: 0px;
        width: 100%;
        background-color: #fff;
        .cart-container{
            padding: 15px 10px;
            &.p0{
            padding: 0;
            }
        }

        .empty{
            font-size: 14px;
            span{
                display: flex; 
                align-items: center;
                color: #e2484f;
                fill: currentColor;

                svg{
                    margin-right: 5px;
                }
            }
            .divider{
                height: 4px;
                border-radius: 2px;
                background-color: #ebebeb;
                margin-top: 5px;
            }
        }

        .something{
            & > span{
                fill: #77bf2a;
                font-size: 14px;
                display: flex; 
                align-items: center;
                svg{
                    margin-right: 5px;
                }
            }

            .divider{
                height: 4px;
                border-radius: 2px;
                background-color: #77bf2a;
                margin-top: 5px;
                margin-bottom: 10px;
            }

            button{
                width: 100%;
                color: white;
                background-color: $d-primary;
                border-radius: 4px;
                padding: 12px 24px;
            }
        }

        .cart-content{
            display:flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
            h3{
                display: flex;
                justify-content: space-between;
                align-items: center;
                fill: $d-text-grey;
                height: 28px;
            }

            .cart-container{
                height: calc( 100% - 140px);
            }

            .cart-container > div{
                height: calc(100% - 28px);
                overflow-y: auto;
            }

            .recap{
                margin-top: 20px;
                @include flex("flex");
                justify-content: space-between;
                .qty{
                    @include flex("vertical");
                    justify-content: space-between;
                    width: 65px;
                    color: #828585;
                    svg{
                        fill: $d-primary;
                        width: 18px;
                        height: 18px;
                    }
                }
                .name{
                    padding-left: 8px;
                    flex-grow: 1;
                    color: #828585;
                }
                .single-total{
                    width: 25%;
                    text-align: right;
                }
            }

            .subtotal{
                margin-top: 25px;
                @include flex("flex");
                & > span:first-child{
                    color: #828585;
                };
                & > span:last-child{
                    display: block;
                    width: 100%;
                    text-align: right;
                }
            }

            .transportation-fee{
                margin: 4px 0;
                @include flex("flex");
                color: #828585;
                & > span:last-child{
                    @include flex("vertical");
                    justify-content: flex-end;
                    flex-grow: 1;
                    svg{
                        fill: currentColor;
                        width: 18px;
                        height: 18px;
                        margin-right: 4px;
                    }
                    .delete{
                        text-decoration: line-through;
                        margin-right: 4px;
                    }
                    .free{
                        color: #e2484f;
                    }
                };
            }

            .savings{
                @include flex("center");
                padding: 10px;
                background-color: #00a396;
                color: white;
            }

            .buttons{
                display: flex;
                flex-direction: column;
                padding: 15px 10px;
                box-shadow: 0px -3px 6px -2px rgb(0 0 0 / 7%);
                color: #fff;

                .empty-the-cart{
                    width: 100%;
                    background-color: #e2484f;
                    border-radius: 3px;
                    padding: 12px 24px;
                    margin-bottom: 10px;
                }

                .pay{
                    text-decoration: none;
                    color: white;
                    text-align: center;
                    width: 100%;
                    background-color: $d-primary;
                    border-radius: 3px;
                    padding: 12px 24px;
                }
            }
        }
    }
    
}

@media screen and (max-width: 580px) {
    .restaurant_description{
        .selectQty{
            .card-box{
                width: unset;
            }
        }
    }
}
</style>
