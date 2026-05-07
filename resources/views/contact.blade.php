<x-layouts.public>
    <x-slot name="title">ArqueoRD | Contacto y Soporte</x-slot>

    <div class="bg-white py-16 md:py-24 border-b border-[#E6DBCB]">
        <div class="container mx-auto px-5">
            <div class="text-center mb-16">
                <span class="text-[#C56A3D] font-bold tracking-widest uppercase text-xs"><i class="fas fa-headset"></i> Soporte y Ayuda</span>
                <h1 class="text-4xl md:text-5xl font-serif font-bold text-[#8B5A2B] mt-2">Comunícate con Nosotros</h1>
                <p class="text-stone-500 mt-4 max-w-2xl mx-auto text-lg">Dirección Nacional de Patrimonio Arqueológico. Estamos aquí para asistir a investigadores y público en general.</p>
            </div>

            <div class="flex flex-col lg:flex-row gap-12 max-w-6xl mx-auto">

                <div class="lg:w-1/2 space-y-8">
                    <div class="bg-[#FDF9F2] p-8 rounded-3xl border border-[#E6DBCB]">
                        <h3 class="text-xl font-bold text-[#1F4E6E] mb-6">Información Oficial</h3>

                        <ul class="space-y-5">
                            <li class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center text-[#C56A3D] shadow-sm flex-shrink-0 text-lg"><i class="fas fa-map-marker-alt"></i></div>
                                <div>
                                    <p class="font-bold text-stone-800">Sede Central - Ministerio de Cultura</p>
                                    <p class="text-sm text-stone-500 mt-1">Av. George Washington, Plaza de la Cultura Juan Pablo Duarte, Santo Domingo, D.N.</p>
                                </div>
                            </li>
                            <li class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center text-[#C56A3D] shadow-sm flex-shrink-0 text-lg"><i class="fas fa-phone-alt"></i></div>
                                <div>
                                    <p class="font-bold text-stone-800">Línea de Atención</p>
                                    <p class="text-sm text-stone-500 mt-1">(809) 221-4141 Ext. Arqueología</p>
                                </div>
                            </li>
                            <li class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center text-[#C56A3D] shadow-sm flex-shrink-0 text-lg"><i class="fas fa-envelope"></i></div>
                                <div>
                                    <p class="font-bold text-stone-800">Correo Electrónico</p>
                                    <p class="text-sm text-[#1F4E6E] font-medium mt-1">patrimonio@arqueord.gob.do</p>
                                </div>
                            </li>
                        </ul>

                        <div class="mt-8 pt-6 border-t border-[#E6DBCB]">
                            <p class="font-bold text-stone-800 mb-4">Síguenos en redes sociales</p>
                            <div class="flex gap-3">
                                <a href="#" class="w-10 h-10 rounded-full bg-[#1F4E6E] text-white flex items-center justify-center hover:bg-[#C56A3D] transition"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="w-10 h-10 rounded-full bg-[#1F4E6E] text-white flex items-center justify-center hover:bg-[#C56A3D] transition"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="w-10 h-10 rounded-full bg-[#1F4E6E] text-white flex items-center justify-center hover:bg-[#C56A3D] transition"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="w-10 h-10 rounded-full bg-[#1F4E6E] text-white flex items-center justify-center hover:bg-[#C56A3D] transition"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="h-48 bg-stone-200 rounded-3xl overflow-hidden border border-[#E6DBCB] relative flex items-center justify-center shadow-sm">
                        <div class="absolute inset-0 opacity-40" style="background-image: url('https://www.transparenttextures.com/patterns/cartographer.png');"></div>
                        <div class="bg-white/90 backdrop-blur px-5 py-3 rounded-xl shadow-md z-10 flex items-center gap-3 text-sm font-bold text-stone-700 hover:scale-105 transition cursor-pointer">
                            <i class="fas fa-map-pin text-red-500 text-lg"></i> Abrir en Google Maps
                        </div>
                    </div>
                </div>

                <div class="lg:w-1/2">
                    <form class="bg-[#FDF9F2] p-8 rounded-3xl shadow-sm border border-[#E6DBCB] h-full flex flex-col">
                        <h3 class="text-2xl font-serif font-bold text-[#8B5A2B] mb-6">Envíanos un mensaje</h3>

                        <div class="space-y-5 flex-grow">
                            <div>
                                <label class="block text-xs font-bold text-stone-500 uppercase mb-2">Nombre Completo</label>
                                <input type="text" class="w-full border-stone-300 rounded-xl py-3 focus:ring-[#C56A3D]/30 focus:border-[#C56A3D]" placeholder="Ingresa tu nombre">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-stone-500 uppercase mb-2">Correo Electrónico</label>
                                <input type="email" class="w-full border-stone-300 rounded-xl py-3 focus:ring-[#C56A3D]/30 focus:border-[#C56A3D]" placeholder="tu@correo.com">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-stone-500 uppercase mb-2">Motivo de Contacto</label>
                                <select class="w-full border-stone-300 rounded-xl py-3 focus:ring-[#C56A3D]/30 focus:border-[#C56A3D] text-stone-600">
                                    <option>Consulta General</option>
                                    <option>Reporte de Hallazgo (Público)</option>
                                    <option>Soporte Técnico del Sistema</option>
                                    <option>Prensa y Medios</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-stone-500 uppercase mb-2">Tu Mensaje</label>
                                <textarea rows="5" class="w-full border-stone-300 rounded-xl focus:ring-[#C56A3D]/30 focus:border-[#C56A3D]" placeholder="¿En qué podemos ayudarte?"></textarea>
                            </div>
                        </div>

                        <button type="submit" class="mt-8 w-full bg-[#1F4E6E] hover:bg-[#153850] text-white py-4 rounded-xl font-bold transition shadow-md flex items-center justify-center gap-2 text-lg">
                            <i class="fas fa-paper-plane"></i> Enviar Mensaje Seguro
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.public>
