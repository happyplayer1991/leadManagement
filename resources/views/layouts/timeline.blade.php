@extends('layouts.master')
@section('heading')
    Timed line
@stop

@section('content')

    <div class="rg normal">
        <div class="timeline-wrapper timeline-accordion">

            <h2 class="timeline-header">Timeline normal</h2>

            <div class="timeline-step">

                <div class="step-header">
                    <div class="step-icon"></div>
                    <div class="step-text">4/6/2017</div>
                </div>

                <div class="step-content">
                    <div class="step-connector">
                    </div>

                    <div class="step-inner">
                        <p>Vestibulum sollicitudin sed est ornare placerat. Suspendisse sodales, ante vitae pharetra venenatis, magna ante dictum nibh, at eleifend risus lectus at felis. In et sagittis nisl, sit amet venenatis ante</p>
                    </div>
                </div>
            </div>

            <div class="timeline-step">

                <div class="step-header">
                    <div class="step-icon"></div>
                    <div class="step-text">4/5/2017</div>
                </div>

                <div class="step-content">
                    <div class="step-connector">
                    </div>

                    <div class="step-inner">
                        <p>Aenean accumsan, justo a egestas venenatis, tortor tellus sollicitudin sapien, vitae iaculis metus enim ac elit. Vivamus sollicitudin bibendum risus, eu tincidunt neque sollicitudin semper. Phasellus in justo finibus, eleifend sem sed, euismod augue. Nam non ante semper, convallis nisi eget, tristique ipsum. Aenean eu venenatis augue, sit amet ultrices enim.</p>
                    </div>
                </div>
            </div>

            <div class="timeline-step">

                <div class="step-header">
                    <div class="step-icon"></div>
                    <div class="step-text">4/4/2017</div>
                </div>

                <div class="step-content">
                    <div class="step-connector">
                    </div>

                    <div class="step-inner">
                        <p>Praesent elementum placerat erat a rhoncus. Pellentesque ac congue augue. Suspendisse scelerisque metus ipsum, id volutpat turpis tempor vitae. Morbi sit amet mauris quam. Phasellus vehicula blandit gravida.</p>
                    </div>
                </div>
            </div>

            <div class="timeline-step">

                <div class="step-header">
                    <div class="step-icon"></div>
                    <div class="step-text">4/3/2017</div>
                </div>

                <div class="step-content">
                    <div class="step-connector">
                    </div>

                    <div class="step-inner">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in convallis nibh. Nunc sodales elit pharetra libero congue sollicitudin. Quisque ullamcorper posuere lacus. Nullam auctor augue et turpis consequat accumsan. Integer fermentum lectus vitae eleifend vehicula. Praesent varius non neque vel pellentesque. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec venenatis lectus in dolor volutpat scelerisque. Morbi convallis tortor vitae tortor gravida mollis.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="rg pre-open">
        <div class="timeline-wrapper timeline-accordion">

            <h2 class="timeline-header">Timeline with pre-opened step</h2>
            <p class="sub">Add <span>active</span> class to a timeline step to make it pre-open.</p>

            <div class="timeline-step">

                <div class="step-header">
                    <div class="step-icon"></div>
                    <div class="step-text">4/6/2017</div>
                </div>

                <div class="step-content">
                    <div class="step-connector">
                    </div>

                    <div class="step-inner">
                        <p>Vestibulum sollicitudin sed est ornare placerat. Suspendisse sodales, ante vitae pharetra venenatis, magna ante dictum nibh, at eleifend risus lectus at felis. In et sagittis nisl, sit amet venenatis ante</p>
                    </div>
                </div>
            </div>

            <div class="timeline-step active">

                <div class="step-header">
                    <div class="step-icon"></div>
                    <div class="step-text">4/5/2017</div>
                </div>

                <div class="step-content">
                    <div class="step-connector">
                    </div>

                    <div class="step-inner">
                        <p>Aenean accumsan, justo a egestas venenatis, tortor tellus sollicitudin sapien, vitae iaculis metus enim ac elit. Vivamus sollicitudin bibendum risus, eu tincidunt neque sollicitudin semper. Phasellus in justo finibus, eleifend sem sed, euismod augue. Nam non ante semper, convallis nisi eget, tristique ipsum. Aenean eu venenatis augue, sit amet ultrices enim.</p>
                    </div>
                </div>
            </div>

            <div class="timeline-step">

                <div class="step-header">
                    <div class="step-icon"></div>
                    <div class="step-text">4/4/2017</div>
                </div>

                <div class="step-content">
                    <div class="step-connector">
                    </div>

                    <div class="step-inner">
                        <p>Praesent elementum placerat erat a rhoncus. Pellentesque ac congue augue. Suspendisse scelerisque metus ipsum, id volutpat turpis tempor vitae. Morbi sit amet mauris quam. Phasellus vehicula blandit gravida.</p>
                    </div>
                </div>
            </div>

            <div class="timeline-step">

                <div class="step-header">
                    <div class="step-icon"></div>
                    <div class="step-text">4/3/2017</div>
                </div>

                <div class="step-content">
                    <div class="step-connector">
                    </div>

                    <div class="step-inner">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in convallis nibh. Nunc sodales elit pharetra libero congue sollicitudin. Quisque ullamcorper posuere lacus. Nullam auctor augue et turpis consequat accumsan. Integer fermentum lectus vitae eleifend vehicula. Praesent varius non neque vel pellentesque. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec venenatis lectus in dolor volutpat scelerisque. Morbi convallis tortor vitae tortor gravida mollis.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="rg no-connector">
        <div class="timeline-wrapper timeline-accordion">

            <h2 class="timeline-header">Timeline with no connectors</h2>
            <p class="sub">Add <span>no-connect</span> class to a timeline step to disable the connector.</p>

            <div class="timeline-step no-connector">

                <div class="step-header">
                    <div class="step-icon"></div>
                    <div class="step-text">4/6/2017</div>
                </div>

                <div class="step-content">
                    <div class="step-connector">
                    </div>

                    <div class="step-inner">
                        <p>Vestibulum sollicitudin sed est ornare placerat. Suspendisse sodales, ante vitae pharetra venenatis, magna ante dictum nibh, at eleifend risus lectus at felis. In et sagittis nisl, sit amet venenatis ante</p>
                    </div>
                </div>
            </div>

            <div class="timeline-step no-connector">

                <div class="step-header">
                    <div class="step-icon"></div>
                    <div class="step-text">4/5/2017</div>
                </div>

                <div class="step-content">
                    <div class="step-connector">
                    </div>

                    <div class="step-inner">
                        <p>Aenean accumsan, justo a egestas venenatis, tortor tellus sollicitudin sapien, vitae iaculis metus enim ac elit. Vivamus sollicitudin bibendum risus, eu tincidunt neque sollicitudin semper. Phasellus in justo finibus, eleifend sem sed, euismod augue. Nam non ante semper, convallis nisi eget, tristique ipsum. Aenean eu venenatis augue, sit amet ultrices enim.</p>
                    </div>
                </div>
            </div>

            <div class="timeline-step no-connector">

                <div class="step-header">
                    <div class="step-icon"></div>
                    <div class="step-text">4/4/2017</div>
                </div>

                <div class="step-content">
                    <div class="step-connector">
                    </div>

                    <div class="step-inner">
                        <p>Praesent elementum placerat erat a rhoncus. Pellentesque ac congue augue. Suspendisse scelerisque metus ipsum, id volutpat turpis tempor vitae. Morbi sit amet mauris quam. Phasellus vehicula blandit gravida.</p>
                    </div>
                </div>
            </div>

            <div class="timeline-step no-connector">

                <div class="step-header">
                    <div class="step-icon"></div>
                    <div class="step-text">4/3/2017</div>
                </div>

                <div class="step-content">
                    <div class="step-connector">
                    </div>

                    <div class="step-inner">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in convallis nibh. Nunc sodales elit pharetra libero congue sollicitudin. Quisque ullamcorper posuere lacus. Nullam auctor augue et turpis consequat accumsan. Integer fermentum lectus vitae eleifend vehicula. Praesent varius non neque vel pellentesque. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec venenatis lectus in dolor volutpat scelerisque. Morbi convallis tortor vitae tortor gravida mollis.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="rg auto-close">
        <div class="timeline-wrapper timeline-accordion" data-accordion="auto-close">

            <h2 class="timeline-header">Timeline with auto-close</h2>
            <p class="sub">Use <span>data-accordion="auto-close"</span> to make only one step visible and close all the others.</p>

            <div class="timeline-step">

                <div class="step-header">
                    <div class="step-icon"></div>
                    <div class="step-text">4/6/2017</div>
                </div>

                <div class="step-content">
                    <div class="step-connector">
                    </div>

                    <div class="step-inner">
                        <p>Vestibulum sollicitudin sed est ornare placerat. Suspendisse sodales, ante vitae pharetra venenatis, magna ante dictum nibh, at eleifend risus lectus at felis. In et sagittis nisl, sit amet venenatis ante</p>
                    </div>
                </div>
            </div>

            <div class="timeline-step">

                <div class="step-header">
                    <div class="step-icon"></div>
                    <div class="step-text">4/5/2017</div>
                </div>

                <div class="step-content">
                    <div class="step-connector">
                    </div>

                    <div class="step-inner">
                        <p>Aenean accumsan, justo a egestas venenatis, tortor tellus sollicitudin sapien, vitae iaculis metus enim ac elit. Vivamus sollicitudin bibendum risus, eu tincidunt neque sollicitudin semper. Phasellus in justo finibus, eleifend sem sed, euismod augue. Nam non ante semper, convallis nisi eget, tristique ipsum. Aenean eu venenatis augue, sit amet ultrices enim.</p>
                    </div>
                </div>
            </div>

            <div class="timeline-step">

                <div class="step-header">
                    <div class="step-icon"></div>
                    <div class="step-text">4/4/2017</div>
                </div>

                <div class="step-content">
                    <div class="step-connector">
                    </div>

                    <div class="step-inner">
                        <p>Praesent elementum placerat erat a rhoncus. Pellentesque ac congue augue. Suspendisse scelerisque metus ipsum, id volutpat turpis tempor vitae. Morbi sit amet mauris quam. Phasellus vehicula blandit gravida.</p>
                    </div>
                </div>
            </div>

            <div class="timeline-step">

                <div class="step-header">
                    <div class="step-icon"></div>
                    <div class="step-text">4/3/2017</div>
                </div>

                <div class="step-content">
                    <div class="step-connector">
                    </div>

                    <div class="step-inner">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in convallis nibh. Nunc sodales elit pharetra libero congue sollicitudin. Quisque ullamcorper posuere lacus. Nullam auctor augue et turpis consequat accumsan. Integer fermentum lectus vitae eleifend vehicula. Praesent varius non neque vel pellentesque. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec venenatis lectus in dolor volutpat scelerisque. Morbi convallis tortor vitae tortor gravida mollis.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="rg pop-out">
        <div class="timeline-wrapper timeline-accordion pop-out">

            <h2 class="timeline-header">Timeline with pop-out</h2>
            <p class="sub">Add <span>pop-out</span> class to a timeline wrapper to make its timeline steps pop out when it's opened.</p>

            <div class="timeline-step">

                <div class="step-header">
                    <div class="step-icon"></div>
                    <div class="step-text">4/6/2017</div>
                </div>

                <div class="step-content">
                    <div class="step-connector">
                    </div>

                    <div class="step-inner">
                        <p>Vestibulum sollicitudin sed est ornare placerat. Suspendisse sodales, ante vitae pharetra venenatis, magna ante dictum nibh, at eleifend risus lectus at felis. In et sagittis nisl, sit amet venenatis ante</p>
                    </div>
                </div>
            </div>

            <div class="timeline-step">

                <div class="step-header">
                    <div class="step-icon"></div>
                    <div class="step-text">4/5/2017</div>
                </div>

                <div class="step-content">
                    <div class="step-connector">
                    </div>

                    <div class="step-inner">
                        <p>Aenean accumsan, justo a egestas venenatis, tortor tellus sollicitudin sapien, vitae iaculis metus enim ac elit. Vivamus sollicitudin bibendum risus, eu tincidunt neque sollicitudin semper. Phasellus in justo finibus, eleifend sem sed, euismod augue. Nam non ante semper, convallis nisi eget, tristique ipsum. Aenean eu venenatis augue, sit amet ultrices enim.</p>
                    </div>
                </div>
            </div>

            <div class="timeline-step">

                <div class="step-header">
                    <div class="step-icon"></div>
                    <div class="step-text">4/4/2017</div>
                </div>

                <div class="step-content">
                    <div class="step-connector">
                    </div>

                    <div class="step-inner">
                        <p>Praesent elementum placerat erat a rhoncus. Pellentesque ac congue augue. Suspendisse scelerisque metus ipsum, id volutpat turpis tempor vitae. Morbi sit amet mauris quam. Phasellus vehicula blandit gravida.</p>
                    </div>
                </div>
            </div>

            <div class="timeline-step">

                <div class="step-header">
                    <div class="step-icon"></div>
                    <div class="step-text">4/3/2017</div>
                </div>

                <div class="step-content">
                    <div class="step-connector">
                    </div>

                    <div class="step-inner">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in convallis nibh. Nunc sodales elit pharetra libero congue sollicitudin. Quisque ullamcorper posuere lacus. Nullam auctor augue et turpis consequat accumsan. Integer fermentum lectus vitae eleifend vehicula. Praesent varius non neque vel pellentesque. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec venenatis lectus in dolor volutpat scelerisque. Morbi convallis tortor vitae tortor gravida mollis.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="rg combined">
        <div class="timeline-wrapper timeline-accordion pop-out" data-accordion="auto-close">

            <h2 class="timeline-header">Timeline combined</h2>
            <p class="sub"><span>data-accordion="auto-close"</span> + <span>pop-out</span> to a timeline-wrapper</p>

            <div class="timeline-step active">

                <div class="step-header">
                    <div class="step-icon"></div>
                    <div class="step-text">4/6/2017</div>
                </div>

                <div class="step-content">
                    <div class="step-connector">
                    </div>

                    <div class="step-inner">
                        <p>Vestibulum sollicitudin sed est ornare placerat. Suspendisse sodales, ante vitae pharetra venenatis, magna ante dictum nibh, at eleifend risus lectus at felis. In et sagittis nisl, sit amet venenatis ante</p>
                    </div>
                </div>
            </div>

            <div class="timeline-step">

                <div class="step-header">
                    <div class="step-icon"></div>
                    <div class="step-text">4/5/2017</div>
                </div>

                <div class="step-content">
                    <div class="step-connector">
                    </div>

                    <div class="step-inner">
                        <p>Aenean accumsan, justo a egestas venenatis, tortor tellus sollicitudin sapien, vitae iaculis metus enim ac elit. Vivamus sollicitudin bibendum risus, eu tincidunt neque sollicitudin semper. Phasellus in justo finibus, eleifend sem sed, euismod augue. Nam non ante semper, convallis nisi eget, tristique ipsum. Aenean eu venenatis augue, sit amet ultrices enim.</p>
                    </div>
                </div>
            </div>

            <div class="timeline-step">

                <div class="step-header">
                    <div class="step-icon"></div>
                    <div class="step-text">4/4/2017</div>
                </div>

                <div class="step-content">
                    <div class="step-connector">
                    </div>

                    <div class="step-inner">
                        <p>Praesent elementum placerat erat a rhoncus. Pellentesque ac congue augue. Suspendisse scelerisque metus ipsum, id volutpat turpis tempor vitae. Morbi sit amet mauris quam. Phasellus vehicula blandit gravida.</p>
                    </div>
                </div>
            </div>

            <div class="timeline-step">

                <div class="step-header">
                    <div class="step-icon"></div>
                    <div class="step-text">4/3/2017</div>
                </div>

                <div class="step-content">
                    <div class="step-connector">
                    </div>

                    <div class="step-inner">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in convallis nibh. Nunc sodales elit pharetra libero congue sollicitudin. Quisque ullamcorper posuere lacus. Nullam auctor augue et turpis consequat accumsan. Integer fermentum lectus vitae eleifend vehicula. Praesent varius non neque vel pellentesque. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec venenatis lectus in dolor volutpat scelerisque. Morbi convallis tortor vitae tortor gravida mollis.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @stop