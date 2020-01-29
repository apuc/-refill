module.exports = {
    devServer: {
        disableHostCheck: true,
        historyApiFallback: true,
        noInfo: true,
        overlay: true,
        proxy: {
            '/api': {
                target: 'http://payment.localhost',
                changeOrigin: true,
// Хедер-метка; ответ на запрос пришел через этот прокси.
                onProxyRes(proxyRes, req, res) {
                    const cookies = proxyRes.headers['set-cookie'];
                    if (!cookies) return;
                    proxyRes.headers['set-cookie'] = [];

                    for (const cookie of cookies) {
                        proxyRes.headers['set-cookie'].push(cookie.replace(/Domain=.*?;/, 'Domain=localhost;'));
                    }
                }
            }
        },
        watchOptions: {
            poll: true,
            ignored: /node_modules/
        },
    },
    css: {
        loaderOptions: {
            sass: {
                prependData: `@import "@/assets/_variables.scss";`
            }
        }
    }
};
