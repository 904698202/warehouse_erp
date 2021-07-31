module.exports = {
    lintOnSave: false,
    devServer:{
        proxy:{
            "/api" : {
                target:"http://api.erp.com",
                ws: true,
                changeOrigin: true,
                pathRewrite: {
                    "^/api": ""
                }
            }
        }
    }
}